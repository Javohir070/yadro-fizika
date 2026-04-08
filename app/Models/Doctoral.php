<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctoral extends Model
{
    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
        'code',
        'file',
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
