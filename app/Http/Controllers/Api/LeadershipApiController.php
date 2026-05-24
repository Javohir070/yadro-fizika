<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeadershipRequest;
use App\Models\Leadership;
use App\Trait\ApiResponseTrait;

class LeadershipApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Rahbariyat kadrlari ma’lumotlari.
     */
    public function index(LeadershipRequest $request)
    {
        $validated = $request->validated();
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];
        $type = $validated['type'] ?? null;

        $paginator = Leadership::query()
            ->with('department')
            ->where('is_active', 1)
            ->whereHas('department', function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);
        
        if ($paginator->isEmpty()) {
            return $this->notFoundResponse('Rahbariyat ma\'lumotlari topilmadi', 200);
        }

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
                'photo' => $this->storagePublicUrl($row->photo),
                'order' => $row->order,
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
