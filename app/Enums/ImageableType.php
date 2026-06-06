<?php

namespace App\Enums;

use App\Models\Gallery;
use App\Models\Laboratory;
use App\Models\News;

enum ImageableType: string
{
    case News = 'news';
    case Laboratory = 'laboratory';
    case Gallery = 'gallery';

    public function modelClass(): string
    {
        return match ($this) {
            self::News => News::class,
            self::Laboratory => Laboratory::class,
            self::Gallery => Gallery::class,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::News => 'Yangilik',
            self::Laboratory => 'Laboratoriya',
            self::Gallery => 'Galereya',
        };
    }

    public function storageDirectory(): string
    {
        return match ($this) {
            self::News => 'news-images',
            self::Laboratory => 'laboratory-images',
            self::Gallery => 'gallery-images',
        };
    }

    public static function fromModelClass(string $modelClass): ?self
    {
        return match ($modelClass) {
            News::class => self::News,
            Laboratory::class => self::Laboratory,
            Gallery::class => self::Gallery,
            default => null,
        };
    }
}
