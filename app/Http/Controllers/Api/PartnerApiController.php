<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Models\Partner;
use App\Trait\ApiResponseTrait;

/**
 * Hamkorlar (logo, havola, tavsif).
 */
class PartnerApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Partner::query()
            ->where('is_active', $status)
            ->latest()
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Partner $partner) use ($lang) {
            return [
                'id' => $partner->id,
                'name' => $partner->{'name_'.$lang},
                'description' => $partner->{'description_'.$lang},
                'link' => $partner->link,
                'image_url' => $this->storagePublicUrl($partner->image),
                'created_at' => $partner->created_at,
                'updated_at' => $partner->updated_at,
            ];
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
