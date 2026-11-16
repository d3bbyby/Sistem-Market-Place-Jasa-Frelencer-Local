<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'title',
        'description',
        'image',
        'project_link',
        'file_path',
        'caption',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(PortfolioRating::class);
    }

    public function imageUrl(): ?string
    {
        $image = $this->image;

        if (! is_string($image) || trim($image) === '') {
            $image = $this->file_path;
        }

        if (! is_string($image) || trim($image) === '') {
            return null;
        }

        $image = trim($image);

        return Str::startsWith($image, ['http://', 'https://'])
            ? $image
            : Storage::disk('public')->url($image);
    }
}
