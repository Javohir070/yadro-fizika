<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Models\VideoGaller;
use App\Trait\ApiResponseTrait;

/**
 * Video galereya. Model nomi tarixan `VideoGaller` — jadval `video_gallers`.
 */
class VideoGalleryApiController extends Controller
{
    use ApiResponseTrait;

    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = VideoGaller::query()
            ->where('is_active', $status)
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (VideoGaller $row) use ($lang) {
            return [
                'id' => $row->id,
                'title' => $row->{'title_'.$lang},
                'description' => $row->{'description_'.$lang},
                'url' => $row->url,
                'order' => $row->order,
                'created_at' => $row->created_at,
                'updated_at' => $row->updated_at,
            ];
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
