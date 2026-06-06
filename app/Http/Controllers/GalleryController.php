<?php

namespace App\Http\Controllers;

use App\Enums\ImageableType;
use App\Http\Controllers\Concerns\HandlesModelImages;
use App\Http\Requests\StoreGalleryImagesRequest;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    use HandlesModelImages;

    public function index(): View
    {
        $galleries = Gallery::query()->withCount('images')->latest()->paginate(12);

        return view('admin.gallery.index', compact('galleries'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['images']);

        $data['image'] = $request->file('image')->store('galleries', 'public');

        $gallery = Gallery::query()->create($data);
        $this->storeUploadedImages($gallery, $request, ImageableType::Gallery);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galereya muvaffaqiyatli yaratildi.');
    }

    public function show(Gallery $gallery): View
    {
        $gallery->load('images');

        return view('admin.gallery.show', compact('gallery'));
    }

    public function storeImages(StoreGalleryImagesRequest $request, Gallery $gallery): RedirectResponse
    {
        $this->storeUploadedImages($gallery, $request, ImageableType::Gallery);

        return redirect()
            ->route('admin.galleries.show', $gallery)
            ->with('success', 'Qo\'shimcha rasmlar muvaffaqiyatli biriktirildi.');
    }

    public function edit(Gallery $gallery): View
    {
        $gallery->load('images');

        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();
        unset($data['images']);

        if ($request->hasFile('image')) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            $data['image'] = $request->file('image')->store('galleries', 'public');
        } else {
            unset($data['image']);
        }

        $gallery->update($data);
        $this->storeUploadedImages($gallery, $request, ImageableType::Gallery);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galereya muvaffaqiyatli yangilandi.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->load('images');
        $this->deleteModelImages($gallery);
        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galereya muvaffaqiyatli o\'chirildi.');
    }
}
