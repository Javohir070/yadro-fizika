<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title_uz',
        'title_ru',
        'title_en',
        'description_uz',
        'description_ru',
        'description_en',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
