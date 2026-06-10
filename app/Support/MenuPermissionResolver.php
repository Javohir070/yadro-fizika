<?php

namespace App\Support;

class MenuPermissionResolver
{
    public static function fromRoute(?string $routeName): ?string
    {
        if ($routeName === 'home.index') {
            return config('menu_permissions.home');
        }

        if (! $routeName || ! str_starts_with($routeName, 'admin.')) {
            return null;
        }

        if (str_starts_with($routeName, 'admin.laboratories.')) {
            return config('menu_permissions.resources.laboratories');
        }

        if (! preg_match('/^admin\.([^.]+)\./', $routeName, $matches)) {
            return null;
        }

        return config('menu_permissions.resources.'.$matches[1]);
    }
}
