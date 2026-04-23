<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstituteStructureRequest;
use App\Http\Requests\UpdateInstituteStructureRequest;
use App\Models\InstituteStructure;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InstituteStructureController extends Controller
{
    public function index(): View
    {
        $instituteStructures = InstituteStructure::query()->latest()->paginate(10);

        return view('admin.institute-structure.index', compact('instituteStructures'));
    }

    public function create(): View
    {
        return view('admin.institute-structure.create');
    }

    public function store(StoreInstituteStructureRequest $request): RedirectResponse
    {
        InstituteStructure::query()->create($request->validated());

        return redirect()
            ->route('admin.institute-structures.index')
            ->with('success', 'Institut tuzilmasi ma\'lumoti muvaffaqiyatli yaratildi.');
    }

    public function show(InstituteStructure $instituteStructure): View
    {
        return view('admin.institute-structure.show', compact('instituteStructure'));
    }

    public function edit(InstituteStructure $instituteStructure): View
    {
        return view('admin.institute-structure.edit', compact('instituteStructure'));
    }

    public function update(UpdateInstituteStructureRequest $request, InstituteStructure $instituteStructure): RedirectResponse
    {
        $instituteStructure->update($request->validated());

        return redirect()
            ->route('admin.institute-structures.index')
            ->with('success', 'Institut tuzilmasi ma\'lumoti muvaffaqiyatli yangilandi.');
    }

    public function destroy(InstituteStructure $instituteStructure): RedirectResponse
    {
        $instituteStructure->delete();

        return redirect()
            ->route('admin.institute-structures.index')
            ->with('success', 'Institut tuzilmasi ma\'lumoti muvaffaqiyatli o\'chirildi.');
    }
}
