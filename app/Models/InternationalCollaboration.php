<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternationalCollaboration extends Model
{
    protected $fillable = [
        'laboratory_id',
        'details_uz',
        'details_ru',
        'details_en',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
