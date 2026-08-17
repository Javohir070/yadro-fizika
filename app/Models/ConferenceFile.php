<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConferenceFile extends Model
{
    protected $fillable = [
        'conference_id',
        'file',
        'original_name',
    ];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }

    public function displayName(): string
    {
        return $this->original_name ?: basename($this->file);
    }
}
