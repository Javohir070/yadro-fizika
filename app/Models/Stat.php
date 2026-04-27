<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        'title_uz',
        'title_ru',
        'title_en',
        'value',
        'suffix',
        'order',
        'is_active',
    ];

    protected $casts = [
        'value' => 'integer',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
