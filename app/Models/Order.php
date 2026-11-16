<?php

namespace App\Models;
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
    ];

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
}
