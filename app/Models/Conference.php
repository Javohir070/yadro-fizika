<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $fillable = [
        'title_uz',
        'title_ru',
        'title_en',
        'description_uz',
        'description_ru',
        'description_en',
        'image',
        'order',
        'start_date',
        'end_date',
        'location_uz',
        'location_ru',
        'location_en',
        'file',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
