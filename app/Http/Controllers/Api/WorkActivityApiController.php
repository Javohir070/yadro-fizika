<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InputRequest;
use App\Http\Requests\LaboratoryRelatedListRequest;
use App\Models\WorkActivity;
use App\Trait\ApiResponseTrait;

class WorkActivityApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Laboratoriya mehnat faoliyatlarining ro’yxati.
     */
    public function index(LaboratoryRelatedListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];
        $laboratoryId = (int) $validated['laboratory_id'];

        $paginator = WorkActivity::query()
            ->with('laboratoryTeam:id,laboratory_id')
            ->where('is_active', $status)
            ->whereHas('laboratoryTeam', function ($query) use ($laboratoryId, $validated) {
                $query->where('laboratory_id', $laboratoryId);

                if (isset($validated['laboratory_team_id'])) {
                    $query->where('id', (int) $validated['laboratory_team_id']);
                }
            })
            ->latest('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(fn (WorkActivity $row) => $this->transform($row, $lang));

        return $this->paginatedSuccessResponse($paginator);
    }

    public function show(int $id, InputRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) ($validated['status'] ?? 1);
        $lang = $this->resolveLang($validated['lang'] ?? 'uz');

        $row = WorkActivity::query()
            ->with('laboratoryTeam:id,laboratory_id')
            ->where('is_active', $status)
            ->find($id);

        if ($row === null) {
            return $this->notFoundResponse('Mehnat faoliyati ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse($this->transform($row, $lang));
    }

    private function transform(WorkActivity $row, string $lang): array
    {
        return [
            'id' => $row->id,
            'laboratory_id' => $row->laboratoryTeam?->laboratory_id,
            'laboratory_team_id' => $row->laboratory_team_id,
            'details' => $row->{'details_'.$lang},
            'created_at' => $row->created_at,
            'updated_at' => $row->updated_at,
        ];
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
