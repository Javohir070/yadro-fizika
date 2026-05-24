<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\InputRequest;
use App\Http\Requests\LaboratoryRelatedListRequest;
use App\Http\Requests\LaboratoryTeamListRequest;
use App\Models\LaboratoryTeam;
use App\Trait\ApiResponseTrait;

class LaboratoryTeamApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Laboratoriya jamoasi ro'yxati.
     */
    public function index(LaboratoryRelatedListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = LaboratoryTeam::query()
            ->where('laboratory_id', (int) $validated['laboratory_id'])
            ->where('is_active', $status)
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(
            fn (LaboratoryTeam $row) => $this->transform($row, $lang)
        );

        return $this->paginatedSuccessResponse($paginator);
    }

    /**
     * Jamoa a'zolari ro'yxati (laboratory_id ixtiyoriy, pagination bilan).
     */
    public function list(LaboratoryTeamListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = LaboratoryTeam::query()
            ->when(isset($validated['laboratory_id']), fn ($query) => $query->where('laboratory_id', (int) $validated['laboratory_id']))
            ->where('is_active', $status)
            ->orderBy('order')
            ->latest('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(
            fn (LaboratoryTeam $row) => $this->transform($row, $lang)
        );

        return $this->paginatedSuccessResponse($paginator);
    }

    /**
     * Laboratoriya jamoasi id bo'yicha asosiy ma'lumot.
     */
    public function show(int $id, InputRequest $request)
    {
        $validated = $request->validated();
        $lang = $this->resolveLang($validated['lang']);

        $team = LaboratoryTeam::query()->find($id);

        if ($team === null) {
            return $this->notFoundResponse('Laboratoriya jamoasi ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse($this->transform($team, $lang));
    }

    private function transform(LaboratoryTeam $row, string $lang): array
    {
        return [
            'id' => $row->id,
            'laboratory_id' => $row->laboratory_id,
            'full_name' => $row->{'full_name_'.$lang},
            'position' => $row->{'position_'.$lang},
            'degree' => $row->{'degree_'.$lang},
            'image' => $this->storagePublicUrl($row->image),
            'google_scholar' => $row->google_scholar,
            'web_of_science' => $row->web_of_science,
            'scopus' => $row->scopus,
            'researchgate' => $row->researchgate,
            'orcid' => $row->orcid,
            'order' => $row->order,
            'is_active' => $row->is_active,
            'created_at' => $row->created_at,
            'updated_at' => $row->updated_at,
        ];
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
