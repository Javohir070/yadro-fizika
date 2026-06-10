<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->with('roles')
            ->latest()
            ->paginate(12);

        return view('admin.user.index', compact('users'));
    }

    public function create(): View
    {
        $roles = Role::query()->where('guard_name', 'web')->orderBy('name')->get();

        return view('admin.user.create', compact('roles'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        $user = User::query()->create($data);
        $user->syncRoles($roles);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Foydalanuvchi muvaffaqiyatli yaratildi.');
    }

    public function show(User $user): View
    {
        $user->load('roles', 'permissions');

        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user): View
    {
        $roles = Role::query()->where('guard_name', 'web')->orderBy('name')->get();
        $user->load('roles');

        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);
        $user->syncRoles($roles);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Foydalanuvchi muvaffaqiyatli yangilandi.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'O\'zingizni o\'chira olmaysiz.');
        }

        if ($user->hasRole('super-admin') && User::role('super-admin')->count() <= 1) {
            return redirect()->back()->with('error', 'Oxirgi super-admin foydalanuvchini o\'chirib bo\'lmaydi.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Foydalanuvchi muvaffaqiyatli o\'chirildi.');
    }
}
