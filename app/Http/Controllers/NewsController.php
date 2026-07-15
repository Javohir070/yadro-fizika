<?php

namespace App\Http\Controllers;

use App\Enums\ImageableType;
use App\Http\Controllers\Concerns\HandlesModelImages;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsController extends Controller
{
    use HandlesModelImages;

    public function index(): View
    {
        $news = News::query()->orderBy('order')->paginate(10);

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
        $this->storeUploadedImages($news, $request, ImageableType::News);

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
        $this->storeUploadedImages($news, $request, ImageableType::News);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Yangilik muvaffaqiyatli yangilandi.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->load('images');
        $this->deleteModelImages($news);
        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Yangilik muvaffaqiyatli o\'chirildi.');
    }
}
