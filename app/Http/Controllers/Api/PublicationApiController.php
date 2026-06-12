<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\InputRequest;
use App\Http\Requests\PublicationListRequest;
use App\Models\Publication;
use App\Trait\ApiResponseTrait;

class PublicationApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Nashrlar ro'yxati.
     */
    public function index(PublicationListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Publication::query()
            ->where('is_active', $status)
            ->where('type', $validated['type'])
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(
            fn (Publication $publication) => $this->transformPublication($publication, $lang)
        );

        return $this->paginatedSuccessResponse($paginator);
    }

    /**
     * Nashr id bo'yicha ma'lumot.
     */
    public function show(int $id, InputRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);

        $publication = Publication::query()
            ->where('is_active', $status)
            ->find($id);

        if ($publication === null) {
            return $this->notFoundResponse('Nashr ma\'lumotlari topilmadi', 404);
        }

        return $this->successResponse($this->transformPublication($publication, $lang));
    }

    private function transformPublication(Publication $publication, string $lang): array
    {
        return [
            'id' => $publication->id,
            'title' => $publication->{'title_'.$lang},
            'type' => $publication->type->value,
            'type_label' => $publication->type->label(),
            'file' => $this->storagePublicUrl($publication->file),
            'order' => $publication->order,
            'created_at' => $publication->created_at,
            'updated_at' => $publication->updated_at,
        ];
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
