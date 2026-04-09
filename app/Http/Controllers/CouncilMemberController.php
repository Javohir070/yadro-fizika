<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouncilMemberRequest;
use App\Http\Requests\UpdateCouncilMemberRequest;
use App\Models\CouncilMember;
use App\Models\ScientificCouncil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CouncilMemberController extends Controller
{
    public function index(): View
    {
        $councilMembers = CouncilMember::query()
            ->with('scientificCouncil')
            ->latest()
            ->paginate(10);

        return view('admin.council-member.index', compact('councilMembers'));
    }

    public function create(): View
    {
        $scientificCouncils = ScientificCouncil::query()->active()->latest()->get();

        return view('admin.council-member.create', compact('scientificCouncils'));
    }

    public function store(StoreCouncilMemberRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['photo'] = $request->file('photo')->store('council-members', 'public');

        CouncilMember::query()->create($data);

        return redirect()
            ->route('admin.council-members.index')
            ->with('success', 'Kengash a\'zosi muvaffaqiyatli yaratildi.');
    }

    public function show(CouncilMember $councilMember): View
    {
        $councilMember->load('scientificCouncil');

        return view('admin.council-member.show', compact('councilMember'));
    }

    public function edit(CouncilMember $councilMember): View
    {
        $scientificCouncils = ScientificCouncil::query()->active()->latest()->get();

        return view('admin.council-member.edit', compact('councilMember', 'scientificCouncils'));
    }

    public function update(UpdateCouncilMemberRequest $request, CouncilMember $councilMember): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($councilMember->photo && Storage::disk('public')->exists($councilMember->photo)) {
                Storage::disk('public')->delete($councilMember->photo);
            }

            $data['photo'] = $request->file('photo')->store('council-members', 'public');
        } else {
            unset($data['photo']);
        }

        $councilMember->update($data);

        return redirect()
            ->route('admin.council-members.index')
            ->with('success', 'Kengash a\'zosi muvaffaqiyatli yangilandi.');
    }

    public function destroy(CouncilMember $councilMember): RedirectResponse
    {
        if ($councilMember->photo && Storage::disk('public')->exists($councilMember->photo)) {
            Storage::disk('public')->delete($councilMember->photo);
        }

        $councilMember->delete();

        return redirect()
            ->route('admin.council-members.index')
            ->with('success', 'Kengash a\'zosi muvaffaqiyatli o\'chirildi.');
    }
}
