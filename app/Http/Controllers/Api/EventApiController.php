<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\Event;
use App\Trait\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class EventApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Tadbirlar ro'yxati.
     */
    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Event::query()
            ->where('is_active', $status)
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Event $event) use ($lang) {
            return $this->formatEventListItem($event, $lang);
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    /**
     * Tadbir id bo'yicha.
     */
    public function show(int $id, InputRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);

        $event = Event::query()
            ->where('id', $id)
            ->where('is_active', $status)
            ->first();

        if ($event === null) {
            return $this->notFoundResponse('Tadbir topilmadi', 404);
        }

        return $this->successResponse($this->formatEvent($event, $lang));
    }

    private function formatEventListItem(Event $event, string $lang): array
    {
        return [
            'id' => $event->id,
            'title' => $event->{'title_'.$lang},
            'image' => $this->storagePublicUrl($event->image),
            'created_at' => $event->created_at,
            'updated_at' => $event->updated_at,
        ];
    }

    private function formatEvent(Event $event, string $lang): array
    {
        return [
            'id' => $event->id,
            'title' => $event->{'title_'.$lang},
            'duties' => $event->{'duties_'.$lang},
            'image' => $this->storagePublicUrl($event->image),
            'created_at' => $event->created_at,
            'updated_at' => $event->updated_at,
        ];
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
