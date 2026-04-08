<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = [
        'news_id',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
