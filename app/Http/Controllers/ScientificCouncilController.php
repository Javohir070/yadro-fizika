<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScientificCouncilRequest;
use App\Http\Requests\UpdateScientificCouncilRequest;
use App\Models\ScientificCouncil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ScientificCouncilController extends Controller
{
    public function index(): View
    {
        $scientificCouncils = ScientificCouncil::query()->latest()->paginate(10);

        return view('admin.scientific-council.index', compact('scientificCouncils'));
    }

    public function create(): View
    {
        return view('admin.scientific-council.create');
    }

    public function store(StoreScientificCouncilRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('scientific-councils', 'public');

        ScientificCouncil::query()->create($data);

        return redirect()
            ->route('admin.scientific-councils.index')
            ->with('success', 'Ilmiy kengash ma\'lumoti muvaffaqiyatli yaratildi.');
    }

    public function show(ScientificCouncil $scientificCouncil): View
    {
        return view('admin.scientific-council.show', compact('scientificCouncil'));
    }

    public function edit(ScientificCouncil $scientificCouncil): View
    {
        return view('admin.scientific-council.edit', compact('scientificCouncil'));
    }

    public function update(UpdateScientificCouncilRequest $request, ScientificCouncil $scientificCouncil): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($scientificCouncil->image && Storage::disk('public')->exists($scientificCouncil->image)) {
                Storage::disk('public')->delete($scientificCouncil->image);
            }

            $data['image'] = $request->file('image')->store('scientific-councils', 'public');
        } else {
            unset($data['image']);
        }

        $scientificCouncil->update($data);

        return redirect()
            ->route('admin.scientific-councils.index')
            ->with('success', 'Ilmiy kengash ma\'lumoti muvaffaqiyatli yangilandi.');
    }

    public function destroy(ScientificCouncil $scientificCouncil): RedirectResponse
    {
        if ($scientificCouncil->image && Storage::disk('public')->exists($scientificCouncil->image)) {
            Storage::disk('public')->delete($scientificCouncil->image);
        }

        $scientificCouncil->delete();

        return redirect()
            ->route('admin.scientific-councils.index')
            ->with('success', 'Ilmiy kengash ma\'lumoti muvaffaqiyatli o\'chirildi.');
    }
}
