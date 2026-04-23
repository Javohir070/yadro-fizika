<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Models\Banner;
use App\Trait\ApiResponseTrait;

/**
 * Bannerlar ro‘yxati — asosan bosh sahifa slayderlari uchun.
 */
class BannerApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Banner::query()
            ->where('is_active', $status)
            ->latest()
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Banner $banner) use ($lang) {
            return [
                'id' => $banner->id,
                'title' => $banner->{'title_'.$lang},
                'description' => $banner->{'description_'.$lang},
                'image_url' => $this->storagePublicUrl($banner->image),
                'created_at' => $banner->created_at,
                'updated_at' => $banner->updated_at,
            ];
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
