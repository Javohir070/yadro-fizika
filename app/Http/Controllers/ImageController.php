<?php

namespace App\Http\Controllers;

use App\Enums\ImageableType;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use App\Models\Laboratory;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ImageController extends Controller
{
    public function index(): View
    {
        $images = Image::query()->with('imageable')->latest()->paginate(12);

        return view('admin.image.index', compact('images'));
    }

    public function create(): View
    {
        $news = News::query()->active()->latest()->get();
        $laboratories = Laboratory::query()->active()->orderBy('order')->get();

        return view('admin.image.create', compact('news', 'laboratories'));
    }

    public function store(StoreImageRequest $request): RedirectResponse
    {
        $type = $request->imageableType();

        Image::query()->create([
            'imageable_type' => $type->modelClass(),
            'imageable_id' => $request->imageableId(),
            'image' => $request->file('image')->store($type->storageDirectory(), 'public'),
            'is_active' => $request->validated()['is_active'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Rasm muvaffaqiyatli yaratildi.');
    }

    public function show(Image $image): View
    {
        $image->load('imageable');

        return view('admin.image.show', compact('image'));
    }

    public function edit(Image $image): View
    {
        $image->load('imageable');
        $news = News::query()->active()->latest()->get();
        $laboratories = Laboratory::query()->active()->orderBy('order')->get();

        return view('admin.image.edit', compact('image', 'news', 'laboratories'));
    }

    public function update(UpdateImageRequest $request, Image $image): RedirectResponse
    {
        $type = $request->imageableType();
        $data = [
            'imageable_type' => $type->modelClass(),
            'imageable_id' => $request->imageableId(),
            'is_active' => $request->validated()['is_active'],
        ];

        if ($request->hasFile('image')) {
            if ($image->image && Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

            $data['image'] = $request->file('image')->store($type->storageDirectory(), 'public');
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
