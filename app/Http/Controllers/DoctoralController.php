<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctoralRequest;
use App\Http\Requests\UpdateDoctoralRequest;
use App\Models\Doctoral;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DoctoralController extends Controller
{
    public function index(): View
    {
        $doctorals = Doctoral::query()->latest()->paginate(10);

        return view('admin.doctoral.index', compact('doctorals'));
    }

    public function create(): View
    {
        return view('admin.doctoral.create');
    }

    public function store(StoreDoctoralRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('doctorals', 'public');
        } else {
            unset($data['file']);
        }

        Doctoral::query()->create($data);

        return redirect()
            ->route('admin.doctorals.index')
            ->with('success', 'Doktorantura yo\'nalishi muvaffaqiyatli yaratildi.');
    }

    public function show(Doctoral $doctoral): View
    {
        return view('admin.doctoral.show', compact('doctoral'));
    }

    public function edit(Doctoral $doctoral): View
    {
        return view('admin.doctoral.edit', compact('doctoral'));
    }

    public function update(UpdateDoctoralRequest $request, Doctoral $doctoral): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            if ($doctoral->file && Storage::disk('public')->exists($doctoral->file)) {
                Storage::disk('public')->delete($doctoral->file);
            }

            $data['file'] = $request->file('file')->store('doctorals', 'public');
        } else {
            unset($data['file']);
        }

        $doctoral->update($data);

        return redirect()
            ->route('admin.doctorals.index')
            ->with('success', 'Doktorantura yo\'nalishi muvaffaqiyatli yangilandi.');
    }

    public function destroy(Doctoral $doctoral): RedirectResponse
    {
        if ($doctoral->file && Storage::disk('public')->exists($doctoral->file)) {
            Storage::disk('public')->delete($doctoral->file);
        }

        $doctoral->delete();

        return redirect()
            ->route('admin.doctorals.index')
            ->with('success', 'Doktorantura yo\'nalishi muvaffaqiyatli o\'chirildi.');
    }
}
