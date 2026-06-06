<?php

namespace App\Models;

use App\Enums\ImageableType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = [
        'imageable_type',
        'imageable_id',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function parentLabel(): ?string
    {
        $parent = $this->imageable;

        if ($parent === null) {
            return null;
        }

        return match ($this->imageable_type) {
            \App\Models\News::class => $parent->title_uz ?? null,
            \App\Models\Laboratory::class => $parent->name_uz ?? null,
            \App\Models\Gallery::class => $parent->title_uz ?? null,
            default => null,
        };
    }

    public function parentTypeLabel(): ?string
    {
        return ImageableType::fromModelClass($this->imageable_type)?->label();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
