<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\Ad;
use App\Trait\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * Elon / matn bloklari ro‘yxati (ko‘p tilli kontent).
 */
class AdApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * E'lonlar ro'yxati
     *
     * @return JsonResponse
     */
    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Ad::query()
            ->where('is_active', $status)
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Ad $ad) use ($lang) {
            return $this->formatAd($ad, $lang);
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    /**
     * E'lon id bo'yicha (status va lang query parametrlari).
     */
    public function show(int $id, InputRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);

        $ad = Ad::query()
            ->where('id', $id)
            ->where('is_active', $status)
            ->first();

        if ($ad === null) {
            return $this->notFoundResponse('E\'lon topilmadi', 404);
        }

        return $this->successResponse($this->formatAd($ad, $lang));
    }

    /**
     * @return array<string, mixed>
     */
    private function formatAd(Ad $ad, string $lang): array
    {
        return [
            'id' => $ad->id,
            'title' => $ad->{'title_'.$lang},
            'description' => $ad->{'description_'.$lang},
            'order' => $ad->order,
            'created_at' => $ad->created_at,
            'updated_at' => $ad->updated_at,
        ];
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
