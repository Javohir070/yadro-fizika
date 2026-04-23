<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\InstituteStructure;
use App\Trait\ApiResponseTrait;

/**
 * Institut tuzilmasi matnlari. `index` — bitta yozuv; `list` — sahifalangan.
 * (Umumiy tuzilma rasmi uchun alohida `structure` endpoint.)
 */
class InstituteStructureApiController extends Controller
{
    use ApiResponseTrait;

    public function index(InputRequest $request)
    {
        $validated = $request->validated();
        $status = (int) ($validated['status'] ?? 1);
        $lang = $this->resolveLang($validated['lang'] ?? 'uz');

        $row = InstituteStructure::query()
            ->selectRaw('id, details_'.$lang.' as content, created_at, updated_at')
            ->where('is_active', $status)
            ->first();

        if ($row === null) {
            return $this->notFoundResponse('Institut tuzilmasi ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse($row);
    }

    public function list(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = InstituteStructure::query()
            ->selectRaw('id, details_'.$lang.' as content, created_at, updated_at')
            ->where('is_active', $status)
            ->latest()
            ->paginate($perPage);

        return $this->paginatedSuccessResponse($paginator);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
