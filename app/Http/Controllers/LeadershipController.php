<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadershipRequest;
use App\Http\Requests\UpdateLeadershipRequest;
use App\Models\Department;
use App\Models\Leadership;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LeadershipController extends Controller
{
    public function index(): View
    {
        $leaderships = Leadership::query()
            ->with('department')
            ->latest()
            ->paginate(10);

        return view('admin.leadership.index', compact('leaderships'));
    }

    public function create(): View
    {
        $departments = Department::query()->active()->orderBy('name_uz')->get();

        return view('admin.leadership.create', compact('departments'));
    }

    public function store(StoreLeadershipRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['photo'] = $request->file('photo')->store('leaderships', 'public');

        Leadership::query()->create($data);

        return redirect()
            ->route('admin.leaderships.index')
            ->with('success', 'Rahbariyat ma\'lumoti muvaffaqiyatli yaratildi.');
    }

    public function show(Leadership $leadership): View
    {
        $leadership->load('department');

        return view('admin.leadership.show', compact('leadership'));
    }

    public function edit(Leadership $leadership): View
    {
        $departments = Department::query()->active()->orderBy('name_uz')->get();

        return view('admin.leadership.edit', compact('leadership', 'departments'));
    }

    public function update(UpdateLeadershipRequest $request, Leadership $leadership): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($leadership->photo && Storage::disk('public')->exists($leadership->photo)) {
                Storage::disk('public')->delete($leadership->photo);
            }

            $data['photo'] = $request->file('photo')->store('leaderships', 'public');
        } else {
            unset($data['photo']);
        }

        $leadership->update($data);

        return redirect()
            ->route('admin.leaderships.index')
            ->with('success', 'Rahbariyat ma\'lumoti muvaffaqiyatli yangilandi.');
    }

    public function destroy(Leadership $leadership): RedirectResponse
    {
        if ($leadership->photo && Storage::disk('public')->exists($leadership->photo)) {
            Storage::disk('public')->delete($leadership->photo);
        }

        $leadership->delete();

        return redirect()
            ->route('admin.leaderships.index')
            ->with('success', 'Rahbariyat ma\'lumoti muvaffaqiyatli o\'chirildi.');
    }
}
