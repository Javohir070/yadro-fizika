<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
        'description_uz',
        'description_ru',
        'description_en',
        'image',
        'link',
        'is_active',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
