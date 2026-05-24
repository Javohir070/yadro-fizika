<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class LaboratoryTeam extends Model
{
    protected $fillable = [
        'laboratory_id',
        'type',
        'full_name_uz',
        'full_name_ru',
        'full_name_en',
        'position_uz',
        'position_ru',
        'position_en',
        'degree_uz',
        'degree_ru',
        'degree_en',
        'image',
        'google_scholar',
        'web_of_science',
        'scopus',
        'researchgate',
        'orcid',
        'order',
        'is_active',
    ];

    protected $casts = [
        'type' => 'integer',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function isLaboratoryDirector(): bool
    {
        return (int) $this->type === 1;
    }

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function workActivities(): HasMany
    {
        return $this->hasMany(WorkActivity::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (blank($this->image)) {
                return null;
            }

            $path = ltrim($this->image, '/');

            if (! Storage::disk('public')->exists($path)) {
                return null;
            }

            return '/storage/'.$path;
        });
    }
}
