<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        $partners = Partner::query()->latest()->paginate(10);

        return view('admin.partner.index', compact('partners'));
    }

    public function create(): View
    {
        return view('admin.partner.create');
    }

    public function store(StorePartnerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('partners', 'public');

        Partner::query()->create($data);

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Hamkor muvaffaqiyatli yaratildi.');
    }

    public function show(Partner $partner): View
    {
        return view('admin.partner.show', compact('partner'));
    }

    public function edit(Partner $partner): View
    {
        return view('admin.partner.edit', compact('partner'));
    }

    public function update(UpdatePartnerRequest $request, Partner $partner): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }

            $data['image'] = $request->file('image')->store('partners', 'public');
        } else {
            unset($data['image']);
        }

        $partner->update($data);

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Hamkor muvaffaqiyatli yangilandi.');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        if ($partner->image && Storage::disk('public')->exists($partner->image)) {
            Storage::disk('public')->delete($partner->image);
        }

        $partner->delete();

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Hamkor muvaffaqiyatli o\'chirildi.');
    }
}
