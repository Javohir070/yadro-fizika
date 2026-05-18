<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScientificActivityRequest;
use App\Http\Requests\UpdateScientificActivityRequest;
use App\Models\Laboratory;
use App\Models\ScientificActivity;
use Illuminate\Http\RedirectResponse;

class ScientificActivityController extends Controller
{
    public function store(StoreScientificActivityRequest $request, Laboratory $laboratory): RedirectResponse
    {
        $laboratory->scientificActivity()->create($request->validated());

        return redirect()
            ->route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'scientific'])
            ->with('success', 'Ilmiy faoliyat saqlandi.');
    }

    public function update(UpdateScientificActivityRequest $request, Laboratory $laboratory, ScientificActivity $scientificActivity): RedirectResponse
    {
        abort_unless($scientificActivity->laboratory_id === $laboratory->id, 404);

        $scientificActivity->update($request->validated());

        return redirect()
            ->route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'scientific'])
            ->with('success', 'Ilmiy faoliyat yangilandi.');
    }
}
