<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\ScientificCouncil;
use App\Trait\ApiResponseTrait;

/**
 * Ilmiy kengash (asosiy blok). A’zolar alohida `council-members` endpointida.
 */
class ScientificCouncilApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    public function index(InputRequest $request)
    {
        $validated = $request->validated();
        $status = (int) ($validated['status'] ?? 1);
        $lang = $this->resolveLang($validated['lang'] ?? 'uz');

        $row = ScientificCouncil::query()
            ->selectRaw(
                'id, title_'.$lang.' as title, council_duties_'.$lang.' as council_duties, image, created_at, updated_at'
            )
            ->where('is_active', $status)
            ->first();

        if ($row === null) {
            return $this->notFoundResponse('Ilmiy kengash ma\'lumotlari topilmadi', 404);
        }

        $payload = $row->toArray();
        $payload['image_url'] = $this->storagePublicUrl($row->image);

        return $this->successResponse($payload);
    }

    public function list(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = ScientificCouncil::query()
            ->selectRaw(
                'id, title_'.$lang.' as title, council_duties_'.$lang.' as council_duties, image, created_at, updated_at'
            )
            ->where('is_active', $status)
            ->latest()
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (ScientificCouncil $council) {
            $arr = $council->toArray();
            $arr['image_url'] = $this->storagePublicUrl($council->image);

            return $arr;
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
