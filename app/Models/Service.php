<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'freelancer_id',
        'category_id',
        'title',
        'description',
        'price',
        'plus_price',
        'premium_price',
        'basic_features',
        'plus_features',
        'premium_features',
        'main_image',
        'gallery_images',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'plus_price' => 'decimal:2',
            'premium_price' => 'decimal:2',
            'basic_features' => 'array',
            'plus_features' => 'array',
            'premium_features' => 'array',
            'gallery_images' => 'array',
        ];
    }

    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return array<string, array{label: string, price: float, features: array<int, string>}>
     */
    public function packages(): array
    {
        return [
            'basic' => [
                'label' => 'Basic',
                'price' => (float) $this->price,
                'features' => $this->basic_features ?: ['Layanan utama sesuai deskripsi jasa'],
            ],
            'plus' => [
                'label' => 'Plus',
                'price' => (float) ($this->plus_price ?? $this->price),
                'features' => $this->plus_features ?: ['Layanan utama sesuai deskripsi jasa'],
            ],
            'premium' => [
                'label' => 'Premium',
                'price' => (float) ($this->premium_price ?? $this->price),
                'features' => $this->premium_features ?: ['Layanan utama sesuai deskripsi jasa'],
            ],
        ];
    }

    public function mainImageUrl(): ?string
    {
        if (! is_string($this->main_image) || $this->main_image === '') {
            return null;
        }

        return Str::startsWith($this->main_image, ['http://', 'https://'])
            ? $this->main_image
            : Storage::disk('public')->url($this->main_image);
    }

    /**
     * @return array<int, string>
     */
    public function galleryImageUrls(): array
    {
        return collect($this->gallery_images ?? [])
            ->filter(fn (mixed $image): bool => is_string($image) && $image !== '')
            ->map(fn (string $image): string => Str::startsWith($image, ['http://', 'https://'])
                ? $image
                : Storage::disk('public')->url($image))
            ->values()
            ->all();
    }
}
