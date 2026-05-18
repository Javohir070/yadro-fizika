<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaboratoryTeamRequest;
use App\Http\Requests\UpdateLaboratoryTeamRequest;
use App\Models\Laboratory;
use App\Models\LaboratoryTeam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LaboratoryTeamController extends Controller
{
    public function show(Laboratory $laboratory, LaboratoryTeam $team): View
    {
        abort_unless($team->laboratory_id === $laboratory->id, 404);

        $team->load('workActivities');

        return view('admin.laboratory.teams.show', compact('laboratory', 'team'));
    }

    public function create(Laboratory $laboratory): View
    {
        return view('admin.laboratory.teams.create', compact('laboratory'));
    }

    public function store(StoreLaboratoryTeamRequest $request, Laboratory $laboratory): RedirectResponse
    {
        $data = $request->validated();
        $data['laboratory_id'] = $laboratory->id;
        $data['image'] = $request->file('image')->store('laboratory-teams', 'public');

        LaboratoryTeam::query()->create($data);

        return redirect()
            ->route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'team'])
            ->with('success', 'Jamoa a\'zosi qo\'shildi.');
    }

    public function edit(Laboratory $laboratory, LaboratoryTeam $team): View
    {
        abort_unless($team->laboratory_id === $laboratory->id, 404);

        return view('admin.laboratory.teams.edit', compact('laboratory', 'team'));
    }

    public function update(UpdateLaboratoryTeamRequest $request, Laboratory $laboratory, LaboratoryTeam $team): RedirectResponse
    {
        abort_unless($team->laboratory_id === $laboratory->id, 404);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($team->image && Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }
            $data['image'] = $request->file('image')->store('laboratory-teams', 'public');
        } else {
            unset($data['image']);
        }

        $team->update($data);

        return redirect()
            ->route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'team'])
            ->with('success', 'Jamoa a\'zosi yangilandi.');
    }

    public function destroy(Laboratory $laboratory, LaboratoryTeam $team): RedirectResponse
    {
        abort_unless($team->laboratory_id === $laboratory->id, 404);

        if ($team->image && Storage::disk('public')->exists($team->image)) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();

        return redirect()
            ->route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'team'])
            ->with('success', 'Jamoa a\'zosi o\'chirildi.');
    }
}
