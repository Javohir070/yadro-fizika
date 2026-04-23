<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\About;
use App\Trait\ApiResponseTrait;

/**
 * Sayt “Haqida” bloki.
 * `index` — birinchi mos yozuv (eski mobil versiyalar uchun).
 * `list` — barcha yozuvlar, sahifalangan (admin bir nechta qator qo‘shgan bo‘lsa).
 */
class AboutApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    public function index(InputRequest $request)
    {
        $validated = $request->validated();
        $status = (int) ($validated['status'] ?? 1);
        $lang = $this->resolveLang($validated['lang'] ?? 'uz');

        $about = About::query()
            ->selectRaw('id, content_'.$lang.' as content, image, created_at, updated_at')
            ->where('is_active', $status)
            ->first();

        if ($about === null) {
            return $this->notFoundResponse('About ma\'lumotlari topilmadi', 404);
        }

        $payload = $about->toArray();
        $payload['image_url'] = $this->storagePublicUrl($about->image);

        return $this->successResponse($payload);
    }

    public function list(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = About::query()
            ->selectRaw('id, content_'.$lang.' as content, image, created_at, updated_at')
            ->where('is_active', $status)
            ->latest()
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (About $about) {
            $arr = $about->toArray();
            $arr['image_url'] = $this->storagePublicUrl($about->image);

            return $arr;
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
