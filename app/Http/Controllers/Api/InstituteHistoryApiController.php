<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\InstituteHistory;
use App\Trait\ApiResponseTrait;

/**
 * Institut tarixi. `index` — bitta yozuv; `list` — sahifalangan.
 */
class InstituteHistoryApiController extends Controller
{
    use ApiResponseTrait;

    public function index(InputRequest $request)
    {
        $validated = $request->validated();
        $status = (int) ($validated['status'] ?? 1);
        $lang = $this->resolveLang($validated['lang'] ?? 'uz');

        $row = InstituteHistory::query()
            ->selectRaw('id, details_'.$lang.' as content, created_at, updated_at')
            ->where('is_active', $status)
            ->first();

        if ($row === null) {
            return $this->notFoundResponse('Institut tarixi ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse($row);
    }

    public function list(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = InstituteHistory::query()
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
