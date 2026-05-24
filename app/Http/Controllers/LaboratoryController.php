<?php

namespace App\Http\Controllers;

use App\Enums\ImageableType;
use App\Http\Controllers\Concerns\HandlesModelImages;
use App\Http\Requests\StoreLaboratoryRequest;
use App\Http\Requests\UpdateLaboratoryRequest;
use App\Models\Laboratory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaboratoryController extends Controller
{
    use HandlesModelImages;

    private const TABS = ['about', 'team', 'scientific', 'international'];

    public function index(): View
    {
        $laboratories = Laboratory::query()->orderBy('order')->paginate(10);

        return view('admin.laboratory.index', compact('laboratories'));
    }

    public function create(): View
    {
        return view('admin.laboratory.create');
    }

    public function store(StoreLaboratoryRequest $request): RedirectResponse
    {
        $laboratory = Laboratory::query()->create($request->validated());

        return redirect()
            ->route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'about'])
            ->with('success', 'Laboratoriya yaratildi. Endi tarkib va boshqa bo\'limlarni to\'ldiring.');
    }

    public function show(Laboratory $laboratory): RedirectResponse
    {
        return redirect()->route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'about']);
    }

    public function edit(Request $request, Laboratory $laboratory): View
    {
        $tab = $request->query('tab', 'about');
        if (! in_array($tab, self::TABS, true)) {
            $tab = 'about';
        }

        $laboratory->load([
            'images',
            'teams' => fn ($q) => $q->orderBy('order'),
            'scientificActivity',
            'internationalCollaboration',
        ]);

        return view('admin.laboratory.edit', compact('laboratory', 'tab'));
    }

    public function update(UpdateLaboratoryRequest $request, Laboratory $laboratory): RedirectResponse
    {
        $data = $request->validated();
        unset($data['images']);

        $laboratory->update($data);
        $this->storeUploadedImages($laboratory, $request, ImageableType::Laboratory);

        return redirect()
            ->route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => 'about'])
            ->with('success', 'Laboratoriya ma\'lumotlari saqlandi.');
    }

    public function destroy(Laboratory $laboratory): RedirectResponse
    {
        $laboratory->load('images');
        $this->deleteModelImages($laboratory);
        $laboratory->delete();

        return redirect()
            ->route('admin.laboratories.index')
            ->with('success', 'Laboratoriya muvaffaqiyatli o\'chirildi.');
    }
}
