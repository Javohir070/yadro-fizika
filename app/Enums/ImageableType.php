<?php

namespace App\Enums;

use App\Models\Laboratory;
use App\Models\News;

enum ImageableType: string
{
    case News = 'news';
    case Laboratory = 'laboratory';

    public function modelClass(): string
    {
        return match ($this) {
            self::News => News::class,
            self::Laboratory => Laboratory::class,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::News => 'Yangilik',
            self::Laboratory => 'Laboratoriya',
        };
    }

    public function storageDirectory(): string
    {
        return match ($this) {
            self::News => 'news-images',
            self::Laboratory => 'laboratory-images',
        };
    }

    public static function fromModelClass(string $modelClass): ?self
    {
        return match ($modelClass) {
            News::class => self::News,
            Laboratory::class => self::Laboratory,
            default => null,
        };
    }
}
