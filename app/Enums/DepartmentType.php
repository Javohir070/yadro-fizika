<?php

namespace App\Enums;

enum DepartmentType: string
{
    case Department = 'department';
    case Division = 'division';
    case Leaders = 'leaders';
    case Other = 'other';



    public function label(): string
    {
        return match ($this) {
                self::Department => 'Bo\'lim',
                self::Division => 'Boshqarma',
                self::Leaders => 'Rahbarlar',
                self::Other => 'Boshqa',
        };
    }
}