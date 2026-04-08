<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leadership extends Model
{
    protected $fillable = [
        'department_id',
        'full_name_uz',
        'full_name_ru',
        'full_name_en',
        'position_uz',
        'position_ru',
        'position_en',
        'phone',
        'email',
        'photo',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
