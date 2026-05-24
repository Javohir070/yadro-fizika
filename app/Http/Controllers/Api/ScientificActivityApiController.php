<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InputRequest;
use App\Http\Requests\LaboratoryRelatedListRequest;
use App\Models\ScientificActivity;
use App\Trait\ApiResponseTrait;

class ScientificActivityApiController extends Controller
{
    use ApiResponseTrait;


    /**
     * Laboratoriya ilmiy faoliyatlarining ro’yxati.
     */
    public function index(LaboratoryRelatedListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = ScientificActivity::query()
            ->where('laboratory_id', (int) $validated['laboratory_id'])
            ->where('is_active', $status)
            ->latest('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(fn (ScientificActivity $row) => $this->transform($row, $lang));

        return $this->paginatedSuccessResponse($paginator);
    }

    public function show(int $id, InputRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) ($validated['status'] ?? 1);
        $lang = $this->resolveLang($validated['lang'] ?? 'uz');

        $row = ScientificActivity::query()
            ->where('is_active', $status)
            ->find($id);

        if ($row === null) {
            return $this->notFoundResponse('Ilmiy faoliyat ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse($this->transform($row, $lang));
    }

    private function transform(ScientificActivity $row, string $lang): array
    {
        return [
            'id' => $row->id,
            'laboratory_id' => $row->laboratory_id,
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
