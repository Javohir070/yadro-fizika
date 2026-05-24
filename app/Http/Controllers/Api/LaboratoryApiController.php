<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\Laboratory;
use App\Trait\ApiResponseTrait;

class LaboratoryApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

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
            ->select([
                'id',
                "name_{$lang}",
                'order',
                'is_active',
                'created_at',
                'updated_at',
            ])
            ->where('is_active', $status)
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(
            fn (Laboratory $laboratory) => $this->transformLaboratoryList($laboratory, $lang)
        );

        return $this->paginatedSuccessResponse($paginator);
    }

    /**
     * Laboratoriya id bo'yicha asosiy ma'lumot.
     */
    public function show(int $id, InputRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);

        $laboratory = Laboratory::query()
            ->with(['images' => fn ($q) => $q->where('is_active', $status)])
            ->find($id);

        if ($laboratory === null) {
            return $this->notFoundResponse('Laboratoriya ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse($this->transformLaboratoryDetail($laboratory, $lang));
    }

    private function transformLaboratoryList(Laboratory $laboratory, string $lang): array
    {
        return [
            'id' => $laboratory->id,
            'name' => $laboratory->{'name_'.$lang},
            'order' => $laboratory->order,
            'is_active' => $laboratory->is_active,
            'created_at' => $laboratory->created_at,
            'updated_at' => $laboratory->updated_at,
        ];
    }

    private function transformLaboratoryDetail(Laboratory $laboratory, string $lang): array
    {
        return [
            ...$this->transformLaboratoryList($laboratory, $lang),
            'content' => $laboratory->{'details_'.$lang},
            'images' => $laboratory->images->map(fn ($image) => [
                'id' => $image->id,
                'url' => $this->storagePublicUrl($image->image),
            ])->values()->all(),
        ];
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
