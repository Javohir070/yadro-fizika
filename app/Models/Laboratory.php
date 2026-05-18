<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Laboratory extends Model
{
    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
        'details_uz',
        'details_ru',
        'details_en',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function teams(): HasMany
    {
        return $this->hasMany(LaboratoryTeam::class)->orderBy('order');
    }

    public function scientificActivity(): HasOne
    {
        return $this->hasOne(ScientificActivity::class);
    }

    public function internationalCollaboration(): HasOne
    {
        return $this->hasOne(InternationalCollaboration::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
