<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Models\Publication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PublicationController extends Controller
{
    public function index(): View
    {
        $publications = Publication::query()
            ->orderBy('order')
            ->latest()
            ->paginate(10);

        return view('admin.publication.index', compact('publications'));
    }

    public function create(): View
    {
        return view('admin.publication.create');
    }

    public function store(StorePublicationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['file'] = $request->file('file')->store('publications', 'public');

        Publication::query()->create($data);

        return redirect()
            ->route('admin.publications.index')
            ->with('success', 'Nashr muvaffaqiyatli yaratildi.');
    }

    public function show(Publication $publication): View
    {
        return view('admin.publication.show', compact('publication'));
    }

    public function edit(Publication $publication): View
    {
        return view('admin.publication.edit', compact('publication'));
    }

    public function update(UpdatePublicationRequest $request, Publication $publication): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            if ($publication->file && Storage::disk('public')->exists($publication->file)) {
                Storage::disk('public')->delete($publication->file);
            }

            $data['file'] = $request->file('file')->store('publications', 'public');
        } else {
            unset($data['file']);
        }

        $publication->update($data);

        return redirect()
            ->route('admin.publications.index')
            ->with('success', 'Nashr muvaffaqiyatli yangilandi.');
    }

    public function destroy(Publication $publication): RedirectResponse
    {
        if ($publication->file && Storage::disk('public')->exists($publication->file)) {
            Storage::disk('public')->delete($publication->file);
        }

        $publication->delete();

        return redirect()
            ->route('admin.publications.index')
            ->with('success', 'Nashr muvaffaqiyatli o\'chirildi.');
    }
}
