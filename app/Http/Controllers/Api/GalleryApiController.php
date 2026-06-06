<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\Gallery;
use App\Trait\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class GalleryApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Galereya ro'yxati — sarlavha (lang) va asosiy rasm.
     */
    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Gallery::query()
            ->where('is_active', $status)
            ->latest()
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Gallery $gallery) use ($lang) {
            return [
                'id' => $gallery->id,
                'title' => $gallery->{'title_'.$lang},
                'image' => $this->storagePublicUrl($gallery->image),
                'created_at' => $gallery->created_at,
                'updated_at' => $gallery->updated_at,
            ];
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    /**
     * Galereya id bo'yicha — barcha sarlavhalar va barcha rasmlar.
     */
    public function show(int $id, InputRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];

        $gallery = Gallery::query()
            ->with(['images' => fn ($q) => $q->where('is_active', $status)])
            ->where('is_active', $status)
            ->find($id);

        if ($gallery === null) {
            return $this->notFoundResponse('Galereya topilmadi', 404);
        }

        return $this->successResponse([
            'id' => $gallery->id,
            'title_uz' => $gallery->title_uz,
            'title_ru' => $gallery->title_ru,
            'title_en' => $gallery->title_en,
            'image' => $this->storagePublicUrl($gallery->image),
            'images' => $gallery->images->map(fn ($image) => [
                'id' => $image->id,
                'image' => $this->storagePublicUrl($image->image),
            ])->values(),
            'created_at' => $gallery->created_at,
            'updated_at' => $gallery->updated_at,
        ]);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
