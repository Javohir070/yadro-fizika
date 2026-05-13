<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Models\Ad;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdController extends Controller
{
    public function index(): View
    {
        $ads = Ad::query()
            ->orderBy('order')
            ->latest('id')
            ->paginate(12);

        return view('admin.ad.index', compact('ads'));
    }

    public function create(): View
    {
        return view('admin.ad.create');
    }

    public function store(StoreAdRequest $request): RedirectResponse
    {
        Ad::query()->create($request->validated());

        return redirect()
            ->route('admin.ads.index')
            ->with('success', 'Elon bloki muvaffaqiyatli yaratildi.');
    }

    public function show(Ad $ad): View
    {
        return view('admin.ad.show', compact('ad'));
    }

    public function edit(Ad $ad): View
    {
        return view('admin.ad.edit', compact('ad'));
    }

    public function update(UpdateAdRequest $request, Ad $ad): RedirectResponse
    {
        $ad->update($request->validated());

        return redirect()
            ->route('admin.ads.index')
            ->with('success', 'Elon bloki muvaffaqiyatli yangilandi.');
    }

    public function destroy(Ad $ad): RedirectResponse
    {
        $ad->delete();

        return redirect()
            ->route('admin.ads.index')
            ->with('success', 'Elon bloki muvaffaqiyatli o\'chirildi.');
    }
}
