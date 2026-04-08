<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScientificCouncil extends Model
{
    protected $fillable = [
        'title_uz',
        'title_ru',
        'title_en',
        'council_duties_uz',
        'council_duties_ru',
        'council_duties_en',
        'image',
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
