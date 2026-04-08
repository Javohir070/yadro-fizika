<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ImageController extends Controller
{
    public function index(): View
    {
        $images = Image::query()->with('news')->latest()->paginate(12);

        return view('admin.image.index', compact('images'));
    }

    public function create(): View
    {
        $news = News::query()->active()->latest()->get();

        return view('admin.image.create', compact('news'));
    }

    public function store(StoreImageRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('news-images', 'public');

        Image::query()->create($data);

        return redirect()
            ->back()
            ->with('success', 'Rasm muvaffaqiyatli yaratildi.');
    }

    public function show(Image $image): View
    {
        $image->load('news');

        return view('admin.image.show', compact('image'));
    }

    public function edit(Image $image): View
    {
        $news = News::query()->active()->latest()->get();

        return view('admin.image.edit', compact('image', 'news'));
    }

    public function update(UpdateImageRequest $request, Image $image): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($image->image && Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

            $data['image'] = $request->file('image')->store('news-images', 'public');
        } else {
            unset($data['image']);
        }

        $image->update($data);

        return redirect()
            ->route('admin.images.index')
            ->with('success', 'Rasm muvaffaqiyatli yangilandi.');
    }

    public function destroy(Image $image): RedirectResponse
    {
        if ($image->image && Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return redirect()
            ->back()
            ->with('success', 'Rasm muvaffaqiyatli o\'chirildi.');
    }
}
