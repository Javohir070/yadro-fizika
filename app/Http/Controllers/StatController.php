<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatRequest;
use App\Http\Requests\UpdateStatRequest;
use App\Models\Stat;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StatController extends Controller
{
    public function index(): View
    {
        $stats = Stat::query()
            ->orderBy('order')
            ->latest('id')
            ->paginate(12);

        return view('admin.stats.index', compact('stats'));
    }

    public function create(): View
    {
        return view('admin.stats.create');
    }

    public function store(StoreStatRequest $request): RedirectResponse
    {
        Stat::query()->create($request->validated());

        return redirect()
            ->route('admin.stats.index')
            ->with('success', 'Stat muvaffaqiyatli yaratildi.');
    }

    public function show(Stat $stat): View
    {
        return view('admin.stats.show', compact('stat'));
    }

    public function edit(Stat $stat): View
    {
        return view('admin.stats.edit', compact('stat'));
    }

    public function update(UpdateStatRequest $request, Stat $stat): RedirectResponse
    {
        $stat->update($request->validated());

        return redirect()
            ->route('admin.stats.index')
            ->with('success', 'Stat muvaffaqiyatli yangilandi.');
    }

    public function destroy(Stat $stat): RedirectResponse
    {
        $stat->delete();

        return redirect()
            ->route('admin.stats.index')
            ->with('success', 'Stat muvaffaqiyatli o\'chirildi.');
    }
}
