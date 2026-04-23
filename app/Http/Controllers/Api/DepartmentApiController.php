<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Models\Department;
use App\Trait\ApiResponseTrait;

/**
 * Bo‘limlar / boshqarmalar ro‘yxati. `type` — `DepartmentType` enum qiymati (string).
 */
class DepartmentApiController extends Controller
{
    use ApiResponseTrait;

    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Department::query()
            ->where('is_active', $status)
            ->orderBy('name_uz')
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Department $row) use ($lang) {
            return [
                'id' => $row->id,
                'name' => $row->{'name_'.$lang},
                'type' => $row->type?->value,
                'created_at' => $row->created_at,
                'updated_at' => $row->updated_at,
            ];
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
