<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use RuntimeException;

class JasaController extends Controller
{
    public function index(Request $request): View
    {
        $this->ensureFreelancer($request);

        $jasa = Service::with('category')
            ->withCount('orders')
            ->where('freelancer_id', $request->user()->id)
            ->latest()
            ->get();

        return view('jasa.index', compact('jasa'));
    }

    public function category(Category $category): View
    {
        $services = Service::with(['category', 'freelancer'])
            ->whereBelongsTo($category)
            ->latest()
            ->paginate(12);

        return view('client.jasa-kategori', compact('category', 'services'));
    }

    public function show(Service $service): View
    {
        $service->load([
            'category',
            'freelancer',
            'freelancer.portfolios' => fn ($query) => $query->latest()->limit(4),
        ]);
        $packages = $service->packages();

        return view('client.detail_jasa', [
            'service' => $service,
            'packages' => $packages,
            'mainImageUrl' => $service->mainImageUrl(),
            'galleryImageUrls' => $service->galleryImageUrls(),
        ]);
    }

    public function create(Request $request): View
    {
        $this->ensureFreelancer($request);

        return view('jasa.create', [
            'categories' => Category::orderBy('category_name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureFreelancer($request);
        $data = $this->validatedServiceData($request);
        $mainImage = $request->file('main_image');
        $galleryImages = $request->file('gallery_images', []);

        $attributes = $this->serviceAttributes($data);
        $attributes['freelancer_id'] = $request->user()->id;
        $attributes['main_image'] = $mainImage instanceof UploadedFile
            ? $this->storeImage($mainImage, 'services')
            : null;
        $attributes['gallery_images'] = collect($galleryImages)
            ->map(fn (UploadedFile $image): string => $this->storeImage($image, 'services/gallery'))
            ->all();

        Service::create($attributes);

        return redirect()->route('jasa.index')->with('success', 'Jasa berhasil ditambahkan!');
    }

    public function edit(Request $request, Service $jasa): View
    {
        $this->authorizeFreelancerService($request, $jasa);

        return view('jasa.edit', [
            'jasa' => $jasa,
            'categories' => Category::orderBy('category_name')->get(),
        ]);
    }

    public function update(Request $request, Service $jasa): RedirectResponse
    {
        $this->authorizeFreelancerService($request, $jasa);
        $data = $this->validatedServiceData($request, true);
        $attributes = $this->serviceAttributes($data);
        $oldImages = [];

        if ($request->hasFile('main_image')) {
            $oldImages[] = $jasa->main_image;
            $attributes['main_image'] = $this->storeImage($request->file('main_image'), 'services');
        }

        if ($request->hasFile('gallery_images')) {
            $oldImages = [...$oldImages, ...($jasa->gallery_images ?? [])];
            $attributes['gallery_images'] = collect($request->file('gallery_images'))
                ->map(fn (UploadedFile $image): string => $this->storeImage($image, 'services/gallery'))
                ->all();
        }

        $jasa->update($attributes);
        $this->deleteStoredImages($oldImages);

        return redirect()->route('jasa.index')->with('success', 'Jasa berhasil diperbarui!');
    }

    public function destroy(Request $request, Service $jasa): RedirectResponse
    {
        $this->authorizeFreelancerService($request, $jasa);

        if ($jasa->orders()->exists()) {
            return redirect()->route('jasa.index')
                ->with('error', 'Jasa tidak dapat dihapus karena sudah memiliki pesanan.');
        }

        $images = [$jasa->main_image, ...($jasa->gallery_images ?? [])];
        $jasa->delete();
        $this->deleteStoredImages($images);

        return redirect()->route('jasa.index')->with('success', 'Jasa berhasil dihapus!');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedServiceData(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'price' => ['required', 'numeric', 'min:0'],
            'plus_price' => ['required', 'numeric', 'min:0'],
            'premium_price' => ['required', 'numeric', 'min:0'],
            'basic_features' => ['required', 'string', 'max:3000'],
            'plus_features' => ['required', 'string', 'max:3000'],
            'premium_features' => ['required', 'string', 'max:3000'],
            'main_image' => [
                $isUpdate ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'gallery_images' => ['nullable', 'array', 'max:8'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function serviceAttributes(array $data): array
    {
        unset($data['main_image'], $data['gallery_images']);

        foreach (['basic_features', 'plus_features', 'premium_features'] as $field) {
            $data[$field] = collect(preg_split('/\R/u', $data[$field]) ?: [])
                ->map(fn (string $feature): string => trim($feature))
                ->filter()
                ->values()
                ->all();
        }

        return $data;
    }

    private function storeImage(UploadedFile $image, string $directory): string
    {
        $path = $image->store($directory, 'public');

        if (! is_string($path)) {
            throw new RuntimeException('Gambar jasa gagal disimpan.');
        }

        return $path;
    }

    /**
     * @param  array<int, mixed>  $images
     */
    private function deleteStoredImages(array $images): void
    {
        foreach (array_filter($images) as $image) {
            if (! is_string($image) || Str::startsWith($image, ['http://', 'https://'])) {
                continue;
            }

            if (! Storage::disk('public')->delete($image)) {
                Log::warning('Unable to remove a service image.', ['path' => $image]);
            }
        }
    }

    private function ensureFreelancer(Request $request): void
    {
        abort_unless($request->user()?->role === 'freelancer', 403);
    }

    private function authorizeFreelancerService(Request $request, Service $service): void
    {
        $this->ensureFreelancer($request);
        abort_unless($service->freelancer_id === $request->user()->id, 404);
    }
}
