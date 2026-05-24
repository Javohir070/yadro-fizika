<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charter extends Model
{
    protected $fillable = [
        'details_uz',
        'details_ru',
        'details_en',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
