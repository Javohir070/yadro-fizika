<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaboratoryRelatedInputRequest;
use App\Models\ScientificActivity;
use App\Trait\ApiResponseTrait;

class ScientificActivityApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Laboratoriya bo'yicha bitta ilmiy faoliyat yozuvi.
     */
    public function index(LaboratoryRelatedInputRequest $request)
    {
        $validated = $request->validated();
        $lang = $this->resolveLang($validated['lang']);
        $laboratoryId = (int) $validated['laboratory_id'];
        $activeOnly = (int) $validated['status'] === 1;

        $row = ScientificActivity::query()
            ->where('laboratory_id', $laboratoryId)
            ->where('is_active', $activeOnly)
            ->first();

        if ($row === null) {
            return $this->notFoundResponse('Ilmiy faoliyat ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse([
            'id' => $row->id,
            'laboratory_id' => $row->laboratory_id,
            'content' => $row->{'details_'.$lang},
            'created_at' => $row->created_at,
            'updated_at' => $row->updated_at,
        ]);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
