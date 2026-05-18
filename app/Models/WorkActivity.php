<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkActivity extends Model
{
    protected $fillable = [
        'laboratory_team_id',
        'details_uz',
        'details_ru',
        'details_en',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function laboratoryTeam(): BelongsTo
    {
        return $this->belongsTo(LaboratoryTeam::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
