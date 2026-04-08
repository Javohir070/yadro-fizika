<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $departments = Department::query()->latest()->paginate(10);

        return view('admin.department.index', compact('departments'));
    }

    public function create(): View
    {
        return view('admin.department.create');
    }

    public function store(StoreDepartmentRequest $request): RedirectResponse
    {
        Department::query()->create($request->validated());

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Bo\'lim muvaffaqiyatli yaratildi.');
    }

    public function show(Department $department): View
    {
        return view('admin.department.show', compact('department'));
    }

    public function edit(Department $department): View
    {
        return view('admin.department.edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department): RedirectResponse
    {
        $department->update($request->validated());

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Bo\'lim muvaffaqiyatli yangilandi.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        $department->delete();

        return redirect()
            ->route('admin.departments.index')
            ->with('success', 'Bo\'lim muvaffaqiyatli o\'chirildi.');
    }
}
