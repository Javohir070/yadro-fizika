<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Models\Gallery;
use App\Trait\ApiResponseTrait;

class GalleryApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Galereya rasmlari ro‘yxati.
     */
    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $perPage = (int) $validated['per_page'];

        $paginator = Gallery::query()
            ->where('is_active', $status)
            ->latest()
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Gallery $gallery) {
            return [
                'id' => $gallery->id,
                'image' => $this->storagePublicUrl($gallery->image),
                'created_at' => $gallery->created_at,
                'updated_at' => $gallery->updated_at,
            ];
        });

        return $this->paginatedSuccessResponse($paginator);
    }
}
