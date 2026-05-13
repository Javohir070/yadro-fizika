<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\UpdateConferenceRequest;
use App\Models\Conference;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    public function index(): View
    {
        $conferences = Conference::query()
            ->orderBy('order')
            ->latest('id')
            ->paginate(12);

        return view('admin.conference.index', compact('conferences'));
    }

    public function create(): View
    {
        return view('admin.conference.create');
    }

    public function store(StoreConferenceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('conferences', 'public');
        } else {
            $data['image'] = null;
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('conferences/files', 'public');
        } else {
            $data['file'] = null;
        }

        Conference::query()->create($data);

        return redirect()
            ->route('admin.conferences.index')
            ->with('success', 'Konferensiya muvaffaqiyatli yaratildi.');
    }

    public function show(Conference $conference): View
    {
        return view('admin.conference.show', compact('conference'));
    }

    public function edit(Conference $conference): View
    {
        return view('admin.conference.edit', compact('conference'));
    }

    public function update(UpdateConferenceRequest $request, Conference $conference): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($conference->image && Storage::disk('public')->exists($conference->image)) {
                Storage::disk('public')->delete($conference->image);
            }
            $data['image'] = $request->file('image')->store('conferences', 'public');
        } else {
            unset($data['image']);
        }

        if ($request->hasFile('file')) {
            if ($conference->file && Storage::disk('public')->exists($conference->file)) {
                Storage::disk('public')->delete($conference->file);
            }
            $data['file'] = $request->file('file')->store('conferences/files', 'public');
        } else {
            unset($data['file']);
        }

        $conference->update($data);

        return redirect()
            ->route('admin.conferences.index')
            ->with('success', 'Konferensiya muvaffaqiyatli yangilandi.');
    }

    public function destroy(Conference $conference): RedirectResponse
    {
        if ($conference->image && Storage::disk('public')->exists($conference->image)) {
            Storage::disk('public')->delete($conference->image);
        }
        if ($conference->file && Storage::disk('public')->exists($conference->file)) {
            Storage::disk('public')->delete($conference->file);
        }

        $conference->delete();

        return redirect()
            ->route('admin.conferences.index')
            ->with('success', 'Konferensiya muvaffaqiyatli o\'chirildi.');
    }
}
