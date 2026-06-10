<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::query()
            ->where('guard_name', 'web')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.permission.index', compact('permissions'));
    }

    public function create(): View
    {
        return view('admin.permission.create');
    }

    public function store(StorePermissionRequest $request): RedirectResponse
    {
        Permission::query()->create([
            'name' => $request->validated('name'),
            'guard_name' => 'web',
        ]);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Ruxsat muvaffaqiyatli yaratildi.');
    }

    public function show(Permission $permission): View
    {
        return view('admin.permission.show', compact('permission'));
    }

    public function edit(Permission $permission): View
    {
        return view('admin.permission.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->validated());

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Ruxsat muvaffaqiyatli yangilandi.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Ruxsat muvaffaqiyatli o\'chirildi.');
    }
}
