<?php

namespace App\Models;

use App\Enums\PublicationType;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'title_uz',
        'title_ru',
        'title_en',
        'type',
        'file',
        'is_active',
        'order',
    ];

    protected $casts = [
        'type' => PublicationType::class,
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
