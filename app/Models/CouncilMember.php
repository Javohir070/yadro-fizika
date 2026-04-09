<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouncilMember extends Model
{
    protected $fillable = [
        'scientific_council_id',
        'full_name_uz',
        'full_name_ru',
        'full_name_en',
        'position_uz',
        'position_ru',
        'position_en',
        'degree_uz',
        'degree_ru',
        'degree_en',
        'photo',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scientificCouncil()
    {
        return $this->belongsTo(ScientificCouncil::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
