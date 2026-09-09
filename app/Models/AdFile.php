<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdFile extends Model
{
    protected $fillable = [
        'ad_id',
        'file',
        'original_name',
    ];

    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class);
    }

    public function displayName(): string
    {
        return $this->original_name ?: basename($this->file);
    }
}
