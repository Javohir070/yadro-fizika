<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $abouts = About::query()->latest()->paginate(10);

        return view('admin.about.index', compact('abouts'));
    }

    public function create(): View
    {
        return view('admin.about.create');
    }

    public function store(StoreAboutRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('abouts', 'public');
        }

        About::query()->create($data);

        return redirect()
            ->route('admin.abouts.index')
            ->with('success', 'About ma\'lumoti muvaffaqiyatli yaratildi.');
    }

    public function show(About $about): View
    {
        return view('admin.about.show', compact('about'));
    }

    public function edit(About $about): View
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(UpdateAboutRequest $request, About $about): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }

            $data['image'] = $request->file('image')->store('abouts', 'public');
        } else {
            unset($data['image']);
        }

        $about->update($data);

        return redirect()
            ->route('admin.abouts.index')
            ->with('success', 'About ma\'lumoti muvaffaqiyatli yangilandi.');
    }

    public function destroy(About $about): RedirectResponse
    {
        if ($about->image && Storage::disk('public')->exists($about->image)) {
            Storage::disk('public')->delete($about->image);
        }

        $about->delete();

        return redirect()
            ->route('admin.abouts.index')
            ->with('success', 'About ma\'lumoti muvaffaqiyatli o\'chirildi.');
    }
}
