<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InputRequest;
use App\Models\InstituteStructure;
use App\Trait\ApiResponseTrait;

class InstituteStructureApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Institut tuzilmasi haqida ma’lumot.
     */
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

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
