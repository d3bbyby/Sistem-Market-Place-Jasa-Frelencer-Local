<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('services')->orderBy('category_name')->get();

        return view('categories.index', compact('categories'));
    }

    public function create(Request $request): View
    {
        $this->ensureAdmin($request);

        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureAdmin($request);
        $data = $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        Category::create([
            'category_name' => $data['category_name'],
            'slug' => $this->uniqueSlug($data['category_name']),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Request $request, Category $category): View
    {
        $this->ensureAdmin($request);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $this->ensureAdmin($request);
        $data = $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        $category->update([
            'category_name' => $data['category_name'],
            'slug' => $this->uniqueSlug($data['category_name'], $category),
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

    private function ensureAdmin(Request $request): void
    {
        abort_unless($request->user()?->role === 'admin', 403);
    }
}
