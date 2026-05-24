<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InputRequest;
use App\Http\Requests\LaboratoryRelatedInputRequest;
use App\Http\Requests\WorkActivityListRequest;
use App\Models\WorkActivity;
use App\Trait\ApiResponseTrait;
use Illuminate\Database\Eloquent\Builder;

class WorkActivityApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Laboratoriya bo'yicha bitta mehnat faoliyati yozuvi.
     */
    public function index(WorkActivityListRequest $request)
    {
        $validated = $request->validated();
        $lang = $this->resolveLang($validated['lang']);
        $activeOnly = (int) $validated['status'] === 1;
        $laboratoryTeamId = (int) $validated['laboratory_team_id'];

        $row = WorkActivity::query()
            ->where('is_active', $activeOnly)
            ->where('laboratory_team_id', $laboratoryTeamId)
            ->first();

        if ($row === null) {
            return $this->notFoundResponse('Mehnat faoliyati ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse($this->transform($row, $lang));
    }

    /**
     * Mehnat faoliyatlari ro'yxati (laboratory_id / laboratory_team_id ixtiyoriy).
     */
    public function list(WorkActivityListRequest $request)
    {
        $validated = $request->validated();
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];
        $activeOnly = (int) $validated['status'] === 1;

        $paginator = $this->buildQuery($validated, $activeOnly)
            ->paginate($perPage);

        $paginator->getCollection()->transform(
            fn (WorkActivity $row) => $this->transform($row, $lang)
        );

        return $this->paginatedSuccessResponse($paginator);
    }

    public function show(int $id, InputRequest $request)
    {
        $lang = $this->resolveLang($request->validated()['lang']);

        $row = WorkActivity::query()
            ->with('laboratoryTeam:id,laboratory_id')
            ->find($id);

        if ($row === null) {
            return $this->notFoundResponse('Mehnat faoliyati ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse($this->transform($row, $lang));
    }

    private function buildQuery(array $validated, bool $activeOnly): Builder
    {
        return WorkActivity::query()
            ->with('laboratoryTeam:id,laboratory_id')
            ->where('is_active', $activeOnly)
            ->whereHas('laboratoryTeam', function ($query) use ($validated, $activeOnly) {
                $query->where('is_active', $activeOnly);

                if (isset($validated['laboratory_id'])) {
                    $query->where('laboratory_id', (int) $validated['laboratory_id']);
                }

                if (isset($validated['laboratory_team_id'])) {
                    $query->where('id', (int) $validated['laboratory_team_id']);
                }
            })
            ->latest('id');
    }

    private function transform(WorkActivity $row, string $lang): array
    {
        return [
            'id' => $row->id,
            'laboratory_team_id' => $row->laboratory_team_id,
            'details' => $row->{'details_'.$lang},
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
