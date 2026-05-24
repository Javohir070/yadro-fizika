<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\Laboratory;
use App\Trait\ApiResponseTrait;

class LaboratoryApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Laboratoriyalar ro'yxati.
     */
    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Laboratory::query()
            ->where('is_active', $status)
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(fn (Laboratory $row) => $this->transformLaboratory($row, $lang));

        return $this->paginatedSuccessResponse($paginator);
    }

    /**
     * Laboratoriya id bo'yicha asosiy ma'lumot.
     */
    public function show(int $id, InputRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) ($validated['status'] ?? 1);
        $lang = $this->resolveLang($validated['lang'] ?? 'uz');

        $laboratory = Laboratory::query()
            ->where('is_active', $status)
            ->find($id);

        if ($laboratory === null) {
            return $this->notFoundResponse('Laboratoriya ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse($this->transformLaboratory($laboratory, $lang));
    }

    private function transformLaboratory(Laboratory $row, string $lang): array
    {
        return [
            'id' => $row->id,
            'name' => $row->{'name_'.$lang},
            'details' => $row->{'details_'.$lang},
            'order' => $row->order,
            'created_at' => $row->created_at,
            'updated_at' => $row->updated_at,
        ];
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
