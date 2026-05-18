<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInternationalCollaborationRequest;
use App\Http\Requests\UpdateInternationalCollaborationRequest;
use App\Models\InternationalCollaboration;
use App\Models\Laboratory;
use Illuminate\Http\RedirectResponse;

class InternationalCollaborationController extends Controller
{
    public function store(StoreInternationalCollaborationRequest $request, Laboratory $laboratory): RedirectResponse
    {
        $laboratory->internationalCollaboration()->create($request->validated());

        return redirect()
            ->route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'international'])
            ->with('success', 'Xalqaro hamkorlik saqlandi.');
    }

    public function update(UpdateInternationalCollaborationRequest $request, Laboratory $laboratory, InternationalCollaboration $internationalCollaboration): RedirectResponse
    {
        abort_unless($internationalCollaboration->laboratory_id === $laboratory->id, 404);

        $internationalCollaboration->update($request->validated());

        return redirect()
            ->route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'international'])
            ->with('success', 'Xalqaro hamkorlik yangilandi.');
    }
}
