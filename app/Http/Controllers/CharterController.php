<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharterRequest;
use App\Http\Requests\UpdateCharterRequest;
use App\Models\Charter;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CharterController extends Controller
{
    public function index(): View
    {
        $charters = Charter::query()->latest()->paginate(10);

        return view('admin.charter.index', compact('charters'));
    }

    public function create(): View
    {
        return view('admin.charter.create');
    }

    public function store(StoreCharterRequest $request): RedirectResponse
    {
        Charter::query()->create($request->validated());

        return redirect()
            ->route('admin.charters.index')
            ->with('success', 'Institut nizomi muvaffaqiyatli yaratildi.');
    }

    public function show(Charter $charter): View
    {
        return view('admin.charter.show', compact('charter'));
    }

    public function edit(Charter $charter): View
    {
        return view('admin.charter.edit', compact('charter'));
    }

    public function update(UpdateCharterRequest $request, Charter $charter): RedirectResponse
    {
        $charter->update($request->validated());

        return redirect()
            ->route('admin.charters.index')
            ->with('success', 'Institut nizomi muvaffaqiyatli yangilandi.');
    }

    public function destroy(Charter $charter): RedirectResponse
    {
        $charter->delete();

        return redirect()
            ->route('admin.charters.index')
            ->with('success', 'Institut nizomi muvaffaqiyatli o\'chirildi.');
    }
}
