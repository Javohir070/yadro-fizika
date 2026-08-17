<?php

namespace App\Http\Controllers;

use App\Enums\ImageableType;
use App\Http\Controllers\Concerns\HandlesModelImages;
use App\Http\Requests\StoreConferenceFilesRequest;
use App\Http\Requests\StoreConferenceImagesRequest;
use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\UpdateConferenceRequest;
use App\Models\Conference;
use App\Models\ConferenceFile;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    use HandlesModelImages;

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
        unset($data['files'], $data['images']);

        $conference = Conference::query()->create($data);
        $this->storeUploadedImages($conference, $request, ImageableType::Conference);
        $this->storeUploadedFiles($conference, $request);

        return redirect()
            ->route('admin.conferences.index')
            ->with('success', 'Konferensiya muvaffaqiyatli yaratildi.');
    }

    public function show(Conference $conference): View
    {
        $conference->load(['files', 'images']);

        return view('admin.conference.show', compact('conference'));
    }

    public function storeImages(StoreConferenceImagesRequest $request, Conference $conference): RedirectResponse
    {
        $this->storeUploadedImages($conference, $request, ImageableType::Conference);

        return redirect()
            ->route('admin.conferences.show', $conference)
            ->with('status', 'create');
    }

    public function storeFiles(StoreConferenceFilesRequest $request, Conference $conference): RedirectResponse
    {
        $this->storeUploadedFiles($conference, $request);

        return redirect()
            ->route('admin.conferences.show', $conference)
            ->with('status', 'create');
    }

    public function edit(Conference $conference): View
    {
        $conference->load(['files', 'images']);

        return view('admin.conference.edit', compact('conference'));
    }

    public function update(UpdateConferenceRequest $request, Conference $conference): RedirectResponse
    {
        $data = $request->validated();
        unset($data['files'], $data['images']);

        $conference->update($data);
        $this->storeUploadedImages($conference, $request, ImageableType::Conference);
        $this->storeUploadedFiles($conference, $request);

        return redirect()
            ->route('admin.conferences.index')
            ->with('success', 'Konferensiya muvaffaqiyatli yangilandi.');
    }

    public function destroyImage(Conference $conference, Image $image): RedirectResponse
    {
        if ($image->imageable_id !== $conference->id || $image->imageable_type !== Conference::class) {
            abort(404);
        }

        if ($image->image && Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return redirect()
            ->back()
            ->with('status', 'delete');
    }

    public function destroyFile(Conference $conference, ConferenceFile $file): RedirectResponse
    {
        if ($file->conference_id !== $conference->id) {
            abort(404);
        }

        if ($file->file && Storage::disk('public')->exists($file->file)) {
            Storage::disk('public')->delete($file->file);
        }

        $file->delete();

        return redirect()
            ->back()
            ->with('status', 'delete');
    }

    public function destroy(Conference $conference): RedirectResponse
    {
        $conference->load(['files', 'images']);
        $this->deleteModelImages($conference);
        $conference->images()->delete();

        foreach ($conference->files as $file) {
            if ($file->file && Storage::disk('public')->exists($file->file)) {
                Storage::disk('public')->delete($file->file);
            }
        }

        $conference->delete();

        return redirect()
            ->route('admin.conferences.index')
            ->with('success', 'Konferensiya muvaffaqiyatli o\'chirildi.');
    }

    private function storeUploadedFiles(Conference $conference, Request $request): void
    {
        if (! $request->hasFile('files')) {
            return;
        }

        foreach ($request->file('files') as $uploadedFile) {
            $conference->files()->create([
                'file' => $uploadedFile->store('conferences/files', 'public'),
                'original_name' => $uploadedFile->getClientOriginalName(),
            ]);
        }
    }
}
