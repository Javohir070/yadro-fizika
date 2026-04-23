<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstituteDirectorRequest;
use App\Http\Requests\UpdateInstituteDirectorRequest;
use App\Models\InstituteDirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InstituteDirectorController extends Controller
{
    public function index(): View
    {
        $instituteDirectors = InstituteDirector::query()->latest()->paginate(10);

        return view('admin.institute-director.index', compact('instituteDirectors'));
    }

    public function create(): View
    {
        return view('admin.institute-director.create');
    }

    public function store(StoreInstituteDirectorRequest $request): RedirectResponse
    {
        InstituteDirector::query()->create($request->validated());

        return redirect()
            ->route('admin.institute-directors.index')
            ->with('success', 'Institut direktori ma\'lumoti muvaffaqiyatli yaratildi.');
    }

    public function show(InstituteDirector $instituteDirector): View
    {
        return view('admin.institute-director.show', compact('instituteDirector'));
    }

    public function edit(InstituteDirector $instituteDirector): View
    {
        return view('admin.institute-director.edit', compact('instituteDirector'));
    }

    public function update(UpdateInstituteDirectorRequest $request, InstituteDirector $instituteDirector): RedirectResponse
    {
        $instituteDirector->update($request->validated());

        return redirect()
            ->route('admin.institute-directors.index')
            ->with('success', 'Institut direktori ma\'lumoti muvaffaqiyatli yangilandi.');
    }

    public function destroy(InstituteDirector $instituteDirector): RedirectResponse
    {
        $instituteDirector->delete();

        return redirect()
            ->route('admin.institute-directors.index')
            ->with('success', 'Institut direktori ma\'lumoti muvaffaqiyatli o\'chirildi.');
    }
}
