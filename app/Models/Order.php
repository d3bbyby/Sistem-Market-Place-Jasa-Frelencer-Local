<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'service_id',
        'package',
        'total_price',
        'status',
        'work_result_file',
        'revision_notes',
        'freelancer_confirmed',
        'client_confirmed',
    ];

    protected function casts(): array
    {
    return [
        'freelancer_confirmed' => 'boolean',
        'client_confirmed' => 'boolean',
    ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function review(): HasOne
    {
    return $this->hasOne(Review::class);
    }

    public function payment(): HasOne
    {
    return $this->hasOne(Payment::class);
    }

    public function ratings(): HasMany
    {
    return $this->hasMany(Rating::class);
    }
}
