<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Models\Leadership;
use App\Trait\ApiResponseTrait;

/**
 * Rahbariyat kadrlari. `department` bog‘lanishi orqali bo‘lim nomi tanlangan tilda qo‘shiladi.
 */
class LeadershipApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Leadership::query()
            ->with('department')
            ->where('is_active', $status)
            ->latest()
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Leadership $row) use ($lang) {
            $dept = $row->department;

            return [
                'id' => $row->id,
                'department_id' => $row->department_id,
                'department_name' => $dept ? $dept->{'name_'.$lang} : null,
                'department_type' => $dept && $dept->type ? $dept->type->value : null,
                'full_name' => $row->{'full_name_'.$lang},
                'position' => $row->{'position_'.$lang},
                'phone' => $row->phone,
                'email' => $row->email,
                'photo_url' => $this->storagePublicUrl($row->photo),
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
