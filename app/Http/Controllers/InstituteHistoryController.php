<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstituteHistoryRequest;
use App\Http\Requests\UpdateInstituteHistoryRequest;
use App\Models\InstituteHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InstituteHistoryController extends Controller
{
    public function index(): View
    {
        $instituteHistories = InstituteHistory::query()->latest()->paginate(10);

        return view('admin.institute-history.index', compact('instituteHistories'));
    }

    public function create(): View
    {
        return view('admin.institute-history.create');
    }

    public function store(StoreInstituteHistoryRequest $request): RedirectResponse
    {
        InstituteHistory::create($request->validated());

        return redirect()
            ->route('admin.institute-histories.index')
            ->with('success', 'Institut tarixi muvaffaqiyatli yaratildi.');
    }

    public function show(InstituteHistory $instituteHistory): View
    {
        return view('admin.institute-history.show', compact('instituteHistory'));
    }

    public function edit(InstituteHistory $instituteHistory): View
    {
        return view('admin.institute-history.edit', compact('instituteHistory'));
    }

    public function update(UpdateInstituteHistoryRequest $request, InstituteHistory $instituteHistory): RedirectResponse
    {
        $instituteHistory->update($request->validated());

        return redirect()
            ->route('admin.institute-histories.index')
            ->with('success', 'Institut tarixi muvaffaqiyatli yangilandi.');
    }

    public function destroy(InstituteHistory $instituteHistory): RedirectResponse
    {
        $instituteHistory->delete();

        return redirect()
            ->route('admin.institute-histories.index')
            ->with('success', 'Institut tarixi muvaffaqiyatli o\'chirildi.');
    }
}
