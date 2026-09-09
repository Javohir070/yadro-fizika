<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdFilesRequest;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Models\Ad;
use App\Models\AdFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdController extends Controller
{
    public function index(): View
    {
        $ads = Ad::query()
            ->orderBy('order')
            ->latest('id')
            ->paginate(12);

        return view('admin.ad.index', compact('ads'));
    }

    public function create(): View
    {
        return view('admin.ad.create');
    }

    public function store(StoreAdRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['files']);

        $ad = Ad::query()->create($data);
        $this->storeUploadedFiles($ad, $request);

        return redirect()
            ->route('admin.ads.index')
            ->with('success', 'Elon bloki muvaffaqiyatli yaratildi.');
    }

    public function show(Ad $ad): View
    {
        $ad->load('files');

        return view('admin.ad.show', compact('ad'));
    }

    public function storeFiles(StoreAdFilesRequest $request, Ad $ad): RedirectResponse
    {
        $this->storeUploadedFiles($ad, $request);

        return redirect()
            ->route('admin.ads.show', $ad)
            ->with('status', 'create');
    }

    public function edit(Ad $ad): View
    {
        $ad->load('files');

        return view('admin.ad.edit', compact('ad'));
    }

    public function update(UpdateAdRequest $request, Ad $ad): RedirectResponse
    {
        $data = $request->validated();
        unset($data['files']);

        $ad->update($data);
        $this->storeUploadedFiles($ad, $request);

        return redirect()
            ->route('admin.ads.index')
            ->with('success', 'Elon bloki muvaffaqiyatli yangilandi.');
    }

    public function destroyFile(Ad $ad, AdFile $file): RedirectResponse
    {
        if ($file->ad_id !== $ad->id) {
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

    public function destroy(Ad $ad): RedirectResponse
    {
        $ad->load('files');

        foreach ($ad->files as $file) {
            if ($file->file && Storage::disk('public')->exists($file->file)) {
                Storage::disk('public')->delete($file->file);
            }
        }

        $ad->delete();

        return redirect()
            ->route('admin.ads.index')
            ->with('success', 'Elon bloki muvaffaqiyatli o\'chirildi.');
    }

    private function storeUploadedFiles(Ad $ad, Request $request): void
    {
        if (! $request->hasFile('files')) {
            return;
        }

        foreach ($request->file('files') as $uploadedFile) {
            $ad->files()->create([
                'file' => $uploadedFile->store('ads/files', 'public'),
                'original_name' => $uploadedFile->getClientOriginalName(),
            ]);
        }
    }
}
