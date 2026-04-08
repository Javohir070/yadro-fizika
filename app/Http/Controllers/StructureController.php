<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStructureRequest;
use App\Http\Requests\UpdateStructureRequest;
use App\Models\Structure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StructureController extends Controller
{
    public function index(): View
    {
        $structures = Structure::query()->latest()->paginate(10);

        return view('admin.structure.index', compact('structures'));
    }

    public function create(): View
    {
        return view('admin.structure.create');
    }

    public function store(StoreStructureRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('structures', 'public');

        Structure::query()->create($data);

        return redirect()
            ->route('admin.structures.index')
            ->with('success', 'Tuzilma muvaffaqiyatli yaratildi.');
    }

    public function show(Structure $structure): View
    {
        return view('admin.structure.show', compact('structure'));
    }

    public function edit(Structure $structure): View
    {
        return view('admin.structure.edit', compact('structure'));
    }

    public function update(UpdateStructureRequest $request, Structure $structure): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($structure->image && Storage::disk('public')->exists($structure->image)) {
                Storage::disk('public')->delete($structure->image);
            }

            $data['image'] = $request->file('image')->store('structures', 'public');
        } else {
            unset($data['image']);
        }

        $structure->update($data);

        return redirect()
            ->route('admin.structures.index')
            ->with('success', 'Tuzilma muvaffaqiyatli yangilandi.');
    }

    public function destroy(Structure $structure): RedirectResponse
    {
        if ($structure->image && Storage::disk('public')->exists($structure->image)) {
            Storage::disk('public')->delete($structure->image);
        }

        $structure->delete();

        return redirect()
            ->route('admin.structures.index')
            ->with('success', 'Tuzilma muvaffaqiyatli o\'chirildi.');
    }
}
