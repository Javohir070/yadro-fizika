<?php

namespace App\Enums;

enum LaboratoryType: string
{
    case Laboratory = 'laboratory';
    case UniqueObject = 'unique_object';

    public function label(): string
    {
        return match ($this) {
            self::Laboratory => 'Laboratoriya',
            self::UniqueObject => 'Noyob obyektlar',
        };
    }
}
