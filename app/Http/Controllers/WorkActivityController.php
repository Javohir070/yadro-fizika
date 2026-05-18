<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkActivityRequest;
use App\Http\Requests\UpdateWorkActivityRequest;
use App\Models\Laboratory;
use App\Models\LaboratoryTeam;
use App\Models\WorkActivity;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WorkActivityController extends Controller
{
    public function create(Laboratory $laboratory, LaboratoryTeam $team): View
    {
        $this->ensureTeamBelongsToLaboratory($laboratory, $team);

        return view('admin.laboratory.work-activities.create', compact('laboratory', 'team'));
    }

    public function store(StoreWorkActivityRequest $request, Laboratory $laboratory, LaboratoryTeam $team): RedirectResponse
    {
        $this->ensureTeamBelongsToLaboratory($laboratory, $team);

        $team->workActivities()->create($request->validated());

        return redirect()
            ->route('admin.laboratories.teams.show', [$laboratory, $team])
            ->with('success', 'Mehnat faoliyati qo\'shildi.');
    }

    public function show(Laboratory $laboratory, LaboratoryTeam $team, WorkActivity $workActivity): View
    {
        $this->ensureTeamBelongsToLaboratory($laboratory, $team);
        $this->ensureWorkActivityBelongsToTeam($team, $workActivity);

        return view('admin.laboratory.work-activities.show', compact('laboratory', 'team', 'workActivity'));
    }

    public function edit(Laboratory $laboratory, LaboratoryTeam $team, WorkActivity $workActivity): View
    {
        $this->ensureTeamBelongsToLaboratory($laboratory, $team);
        $this->ensureWorkActivityBelongsToTeam($team, $workActivity);

        return view('admin.laboratory.work-activities.edit', compact('laboratory', 'team', 'workActivity'));
    }

    public function update(UpdateWorkActivityRequest $request, Laboratory $laboratory, LaboratoryTeam $team, WorkActivity $workActivity): RedirectResponse
    {
        $this->ensureTeamBelongsToLaboratory($laboratory, $team);
        $this->ensureWorkActivityBelongsToTeam($team, $workActivity);

        $workActivity->update($request->validated());

        return redirect()
            ->route('admin.laboratories.teams.show', [$laboratory, $team])
            ->with('success', 'Mehnat faoliyati yangilandi.');
    }

    public function destroy(Laboratory $laboratory, LaboratoryTeam $team, WorkActivity $workActivity): RedirectResponse
    {
        $this->ensureTeamBelongsToLaboratory($laboratory, $team);
        $this->ensureWorkActivityBelongsToTeam($team, $workActivity);

        $workActivity->delete();

        return redirect()
            ->route('admin.laboratories.teams.show', [$laboratory, $team])
            ->with('success', 'Mehnat faoliyati o\'chirildi.');
    }

    private function ensureTeamBelongsToLaboratory(Laboratory $laboratory, LaboratoryTeam $team): void
    {
        abort_unless($team->laboratory_id === $laboratory->id, 404);
    }

    private function ensureWorkActivityBelongsToTeam(LaboratoryTeam $team, WorkActivity $workActivity): void
    {
        abort_unless($workActivity->laboratory_team_id === $team->id, 404);
    }
}
