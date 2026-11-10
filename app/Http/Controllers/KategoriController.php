<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->whereNull('parent_category_id')
            ->withCount('services')
            ->with(['children' => fn ($query) => $query->withCount('services')->orderBy('category_name')])
            ->orderBy('category_name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function create(Request $request): View
    {
        $this->ensureAdmin($request);

        return view('categories.create', [
            'parentCategories' => $this->availableParentCategories(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureAdmin($request);
        $data = $this->validatedCategoryData($request);

        Category::create([
            'category_name' => $data['category_name'],
            'slug' => $this->uniqueSlug($data['category_name']),
            'parent_category_id' => $data['parent_category_id'] ?? null,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Request $request, Category $category): View
    {
        $this->ensureAdmin($request);

        return view('categories.edit', [
            'category' => $category,
            'parentCategories' => $this->availableParentCategories($category),
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $this->ensureAdmin($request);
        $data = $this->validatedCategoryData($request, $category);

        $category->update([
            'category_name' => $data['category_name'],
            'slug' => $this->uniqueSlug($data['category_name'], $category),
            'parent_category_id' => $data['parent_category_id'] ?? null,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Request $request, Category $category): RedirectResponse
    {
        $this->ensureAdmin($request);

        if ($category->services()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh jasa.');
        }

        if ($category->children()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori utama tidak dapat dihapus karena masih memiliki subkategori.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }

    private function uniqueSlug(string $name, ?Category $category = null): string
    {
        $baseSlug = Str::slug($name) ?: 'kategori';
        $slug = $baseSlug;
        $suffix = 2;

        while (Category::query()
            ->where('slug', $slug)
            ->when($category, fn ($query) => $query->where('id', '!=', $category->getKey()))
            ->exists()) {
            $slug = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }

    /**
     * @return array{category_name: string, parent_category_id?: int|null}
     */
    private function validatedCategoryData(Request $request, ?Category $category = null): array
    {
        $data = $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
            'parent_category_id' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        $parentId = $data['parent_category_id'] ?? null;

        if ($parentId !== null) {
            $parent = Category::query()->find($parentId);

            if (
                $parent?->parent_category_id !== null ||
                $parent?->is($category) ||
                $category?->children()->exists()
            ) {
                throw ValidationException::withMessages([
                    'parent_category_id' => 'Pilih kategori utama tanpa subkategori agar susunannya tetap satu tingkat.',
                ]);
            }
        }

        return $data;
    }

    /**
     * @return Collection<int, Category>
     */
    private function availableParentCategories(?Category $category = null): Collection
    {
        return Category::query()
            ->whereNull('parent_category_id')
            ->when($category, fn ($query) => $query->where('id', '!=', $category->getKey()))
            ->orderBy('category_name')
            ->get();
    }

    private function ensureAdmin(Request $request): void
    {
        abort_unless($request->user()?->role === 'admin', 403);
    }
}
