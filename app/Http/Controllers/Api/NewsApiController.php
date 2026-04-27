<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\News;
use App\Trait\ApiResponseTrait;

class NewsApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Yangiliklar ma’lumotlari.
     */
    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = News::query()
            ->with(['images' => fn ($q) => $q->where('is_active', $status)])
            ->where('is_active', $status)
            ->latest()
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (News $news) use ($lang) {
            return [
                'id' => $news->id,
                'title' => $news->{'title_'.$lang},
                'description' => $news->{'description_'.$lang},
                'images' => $news->images->map(fn ($img) => [
                    'id' => $img->id,
                    'url' => $this->storagePublicUrl($img->image),
                ])->values()->all(),
                'created_at' => $news->created_at,
                'updated_at' => $news->updated_at,
            ];
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    /**
     * Yangilik id bo'yicha ma’lumotlari.
     */
    public function show(int $id, InputRequest $request)
    {
        $validated = $request->validated();
        $lang = $this->resolveLang($validated['lang']);

        $news = News::query()->with(['images' => fn ($q) => $q->where('is_active', 1)])->findOrFail($id);

        if ($news === null) {
            return $this->notFoundResponse('Yangilik ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse([
            'id' => $news->id,
            'title' => $news->{'title_'.$lang},
            'description' => $news->{'description_'.$lang},
            'images' => $news->images->map(fn ($img) => [
                'id' => $img->id,
                'url' => $this->storagePublicUrl($img->image),
            ])->values()->all(),
            'created_at' => $news->created_at,
            'updated_at' => $news->updated_at,
        ]);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
