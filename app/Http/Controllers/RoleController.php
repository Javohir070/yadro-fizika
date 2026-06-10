<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::query()
            ->with('permissions')
            ->where('guard_name', 'web')
            ->orderBy('name')
            ->paginate(12);

        return view('admin.role.index', compact('roles'));
    }

    public function create(): View
    {
        $permissions = $this->groupedPermissions();

        return view('admin.role.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $permissions = $data['permissions'] ?? [];
        unset($data['permissions']);

        $role = Role::query()->create([
            'name' => $data['name'],
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($permissions);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rol muvaffaqiyatli yaratildi.');
    }

    public function show(Role $role): View
    {
        $role->load('permissions');

        return view('admin.role.show', compact('role'));
    }

    public function edit(Role $role): View
    {
        $permissions = $this->groupedPermissions();
        $role->load('permissions');

        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        if ($role->name === 'super-admin' && $request->input('name') !== 'super-admin') {
            return redirect()->back()->with('error', 'super-admin rolini qayta nomlash mumkin emas.');
        }

        $data = $request->validated();
        $permissions = $data['permissions'] ?? [];
        unset($data['permissions']);

        $role->update(['name' => $data['name']]);
        $role->syncPermissions($permissions);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rol muvaffaqiyatli yangilandi.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->name === 'super-admin') {
            return redirect()->back()->with('error', 'super-admin rolini o\'chirib bo\'lmaydi.');
        }

        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rol muvaffaqiyatli o\'chirildi.');
    }

    /**
     * @return array<string, Collection<int, Permission>>
     */
    private function groupedPermissions(): array
    {
        $menuPermissions = collect(config('menu_permissions.resources'))
            ->prepend(config('menu_permissions.home'), 'home')
            ->values();

        $settingsPermissions = collect(['Sozlamalar', 'Foydalanuvchilar', 'Rollar', 'Ruxsatlar']);

        $permissions = Permission::query()
            ->where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        return [
            'Asosiy' => $permissions->filter(fn (Permission $p) => $menuPermissions->contains($p->name)),
            'Sozlamalar' => $permissions->filter(fn (Permission $p) => $settingsPermissions->contains($p->name)),
            'Boshqa' => $permissions->filter(
                fn (Permission $p) => ! $menuPermissions->contains($p->name) && ! $settingsPermissions->contains($p->name)
            ),
        ];
    }
}
