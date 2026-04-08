<?php

namespace App\Models;

use App\Enums\DepartmentType;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
        'type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'type' => DepartmentType::class,
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
