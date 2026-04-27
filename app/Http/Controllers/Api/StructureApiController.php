<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\InputRequest;
use App\Models\Structure;
use App\Trait\ApiResponseTrait;

class StructureApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Tuzilma sxemasi rasmlari (tilga bog‘liq matn yo‘q).
     */
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
        $payload['image'] = $this->storagePublicUrl($structure->image);

        return $this->successResponse($payload);
    }

}
