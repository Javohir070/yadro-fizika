<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = Banner::query()->latest()->paginate(10);

        return view('admin.banner.index', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.banner.create');
    }

    public function store(StoreBannerRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        Banner::query()->create($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner muvaffaqiyatli yaratildi.');
    }

    public function show(Banner $banner): View
    {
        return view('admin.banner.show', compact('banner'));
    }

    public function edit(Banner $banner): View
    {
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $data['image'] = $request->file('image')->store('banners', 'public');
        } else {
            unset($data['image']);
        }

        $banner->update($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner muvaffaqiyatli yangilandi.');
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->back()
            ->with('success', 'Banner muvaffaqiyatli o\'chirildi.');
    }
}
