<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::query()->latest()->paginate(12);

        return view('admin.gallery.index', compact('galleries'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('galleries', 'public');

        Gallery::query()->create($data);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galereya rasmi muvaffaqiyatli yaratildi.');
    }

    public function show(Gallery $gallery): View
    {
        return view('admin.gallery.show', compact('gallery'));
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            $data['image'] = $request->file('image')->store('galleries', 'public');
        } else {
            unset($data['image']);
        }

        $gallery->update($data);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galereya rasmi muvaffaqiyatli yangilandi.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galereya rasmi muvaffaqiyatli o\'chirildi.');
    }
}
