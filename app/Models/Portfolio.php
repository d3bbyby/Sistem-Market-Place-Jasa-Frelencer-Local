<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $fillable = [
        'service_id',
        'file_path',
        'caption',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
