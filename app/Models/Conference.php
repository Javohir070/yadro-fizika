<?php

namespace App\Models;

use App\Models\Concerns\HasImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conference extends Model
{
    use HasImages;

    protected $fillable = [
        'title_uz',
        'title_ru',
        'title_en',
        'description_uz',
        'description_ru',
        'description_en',
        'order',
        'start_date',
        'end_date',
        'location_uz',
        'location_ru',
        'location_en',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(ConferenceFile::class)->latest('id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
