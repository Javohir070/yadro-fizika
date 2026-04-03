<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'content_uz',
        'content_ru',
        'content_en',
        'image',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
