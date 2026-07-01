<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::query()->latest()->paginate(10);

        return view('admin.event.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.event.create');
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('events', 'public');

        Event::query()->create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Tadbir muvaffaqiyatli yaratildi.');
    }

    public function show(Event $event): View
    {
        return view('admin.event.show', compact('event'));
    }

    public function edit(Event $event): View
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            $data['image'] = $request->file('image')->store('events', 'public');
        } else {
            unset($data['image']);
        }

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Tadbir muvaffaqiyatli yangilandi.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Tadbir muvaffaqiyatli o\'chirildi.');
    }
}
