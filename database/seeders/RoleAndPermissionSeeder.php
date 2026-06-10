<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            config('menu_permissions.home'),
            ...array_values(config('menu_permissions.resources')),
            'Sozlamalar',
        ];

        foreach (array_unique($permissions) as $permission) {
            Permission::query()->firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::query()->firstOrCreate([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);

        $superAdmin->syncPermissions(Permission::query()->where('guard_name', 'web')->get());

        $admin = User::query()->where('email', 'admin@gmail.com')->first();

        if ($admin && ! $admin->hasRole('super-admin')) {
            $admin->assignRole('super-admin');
        }
    }
}
