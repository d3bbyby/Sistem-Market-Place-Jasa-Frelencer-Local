<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $this->ensureFreelancer($request);

        $portfolios = Portfolio::with('service')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('portfolios.index', compact('portfolios'));
    }

    public function create(Request $request): View
    {
        $this->ensureFreelancer($request);

        return view('portfolios.create', [
            'services' => Service::where('freelancer_id', $request->user()->id)
                ->orderBy('title')
                ->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureFreelancer($request);
        $data = $this->validatedPortfolioData($request);
        $image = $request->file('image');

        if (! $image instanceof UploadedFile) {
            throw new RuntimeException('Gambar portofolio wajib diunggah.');
        }

        $path = $this->storeImage($image);
        $title = $data['title'];

        Portfolio::create([
            'user_id' => $request->user()->id,
            'service_id' => $data['service_id'] ?? null,
            'title' => $title,
            'description' => $data['description'] ?? null,
            'image' => $path,
            'project_link' => $data['project_link'] ?? null,
            'caption' => $title,
            'file_path' => $path,
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function edit(Request $request, Portfolio $portfolio): View
    {
        $this->authorizePortfolio($request, $portfolio);

        return view('portfolios.edit', [
            'portfolio' => $portfolio,
            'services' => Service::where('freelancer_id', $request->user()->id)
                ->orderBy('title')
                ->get(),
        ]);
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $this->authorizePortfolio($request, $portfolio);
        $data = $this->validatedPortfolioData($request, true);
        $oldImage = $portfolio->image;

        $portfolio->update([
            'service_id' => $data['service_id'] ?? null,
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'project_link' => $data['project_link'] ?? null,
            'caption' => $data['title'],
        ]);

        if ($request->hasFile('image')) {
            $path = $this->storeImage($request->file('image'));
            $portfolio->update([
                'image' => $path,
                'file_path' => $path,
            ]);
            $this->deleteStoredImage($oldImage);
        }

        return redirect()->route('portfolios.index')->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function destroy(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $this->authorizePortfolio($request, $portfolio);
        $image = $portfolio->image;

        $portfolio->delete();
        $this->deleteStoredImage($image);

        return redirect()->route('portfolios.index')->with('success', 'Portofolio berhasil dihapus!');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedPortfolioData(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'service_id' => [
                'nullable',
                Rule::exists('services', 'id')
                    ->where(fn (QueryBuilder $query): QueryBuilder => $query->where('freelancer_id', $request->user()->id)),
            ],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'project_link' => ['nullable', 'url:http,https', 'max:2048'],
            'image' => [
                $isUpdate ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);
    }

    private function storeImage(UploadedFile $image): string
    {
        $path = $image->store('portfolios', 'public');

        if (! is_string($path)) {
            throw new RuntimeException('Gambar portofolio gagal disimpan.');
        }

        return $path;
    }

    private function deleteStoredImage(mixed $image): void
    {
        if (! is_string($image) || $image === '' || Str::startsWith($image, ['http://', 'https://'])) {
            return;
        }

        if (! Storage::disk('public')->delete($image)) {
            Log::warning('Unable to remove a portfolio image.', ['path' => $image]);
        }
    }

    private function ensureFreelancer(Request $request): void
    {
        abort_unless($request->user()?->role === 'freelancer', 403);
    }

    private function authorizePortfolio(Request $request, Portfolio $portfolio): void
    {
        $this->ensureFreelancer($request);
        abort_unless($portfolio->user_id === $request->user()->id, 404);
    }
}
