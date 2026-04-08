<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Image;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::query()->latest()->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['images']);

        $news = News::query()->create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $uploadedImage) {
                Image::query()->create([
                    'news_id' => $news->id,
                    'image' => $uploadedImage->store('news-images', 'public'),
                    'is_active' => true,
                ]);
            }
        }

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Yangilik muvaffaqiyatli yaratildi.');
    }

    public function show(News $news): View
    {
        $news->load('images');

        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news): View
    {
        $news->load('images');

        return view('admin.news.edit', compact('news'));
    }

    public function update(UpdateNewsRequest $request, News $news): RedirectResponse
    {
        $data = $request->validated();
        unset($data['images']);

        $news->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $uploadedImage) {
                Image::query()->create([
                    'news_id' => $news->id,
                    'image' => $uploadedImage->store('news-images', 'public'),
                    'is_active' => true,
                ]);
            }
        }

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Yangilik muvaffaqiyatli yangilandi.');
    }

    public function destroy(News $news): RedirectResponse
    {
        foreach ($news->images as $image) {
            if ($image->image && Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Yangilik muvaffaqiyatli o\'chirildi.');
    }
}
