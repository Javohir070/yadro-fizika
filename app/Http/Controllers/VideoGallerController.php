<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoGallerRequest;
use App\Http\Requests\UpdateVideoGallerRequest;
use App\Models\VideoGaller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VideoGallerController extends Controller
{
    public function index(): View
    {
        $videoGallers = VideoGaller::query()
            ->orderBy('order')
            ->latest('id')
            ->paginate(10);

        return view('admin.video-galler.index', compact('videoGallers'));
    }

    public function create(): View
    {
        return view('admin.video-galler.create');
    }

    public function store(StoreVideoGallerRequest $request): RedirectResponse
    {
        VideoGaller::query()->create($request->validated());

        return redirect()
            ->route('admin.video-gallers.index')
            ->with('success', 'Video muvaffaqiyatli yaratildi.');
    }

    public function show(VideoGaller $videoGaller): View
    {
        return view('admin.video-galler.show', compact('videoGaller'));
    }

    public function edit(VideoGaller $videoGaller): View
    {
        return view('admin.video-galler.edit', compact('videoGaller'));
    }

    public function update(UpdateVideoGallerRequest $request, VideoGaller $videoGaller): RedirectResponse
    {
        $videoGaller->update($request->validated());

        return redirect()
            ->route('admin.video-gallers.index')
            ->with('success', 'Video muvaffaqiyatli yangilandi.');
    }

    public function destroy(VideoGaller $videoGaller): RedirectResponse
    {
        $videoGaller->delete();

        return redirect()
            ->route('admin.video-gallers.index')
            ->with('success', 'Video muvaffaqiyatli o\'chirildi.');
    }
}
