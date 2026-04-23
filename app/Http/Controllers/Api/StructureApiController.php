<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\Structure;
use App\Trait\ApiResponseTrait;

/**
 * Tuzilma sxemasi rasmlari (tilga bog‘liq matn yo‘q).
 */
class StructureApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    public function index(InputRequest $request)
    {
        $validated = $request->validated();
        $status = (int) ($validated['status'] ?? 1);

        $structure = Structure::query()
            ->select('id', 'image', 'created_at', 'updated_at')
            ->where('is_active', $status)
            ->first();

        if ($structure === null) {
            return $this->notFoundResponse('Tuzilma ma\'lumotlari topilmadi', 404);
        }

        $payload = $structure->toArray();
        $payload['image_url'] = $this->storagePublicUrl($structure->image);

        return $this->successResponse($payload);
    }

    public function list(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $perPage = (int) $validated['per_page'];

        $paginator = Structure::query()
            ->select('id', 'image', 'created_at', 'updated_at')
            ->where('is_active', $status)
            ->latest()
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Structure $row) {
            $arr = $row->toArray();
            $arr['image_url'] = $this->storagePublicUrl($row->image);

            return $arr;
        });

        return $this->paginatedSuccessResponse($paginator);
    }
}
