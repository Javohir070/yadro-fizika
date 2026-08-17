<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Http\Requests\InputRequest;
use App\Models\Conference;
use App\Models\ConferenceFile;
use App\Models\Image;
use App\Trait\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * Konferensiyalar ro‘yxati (ko‘p tilli kontent, rasm va ixtiyoriy fayllar).
 */
class ConferenceApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Konferensiyalar ro'yxati
     *
     */
    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Conference::query()
            ->where('is_active', $status)
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Conference $conference) use ($lang) {
            return $this->formatConference($conference, $lang, false);
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    /**
     * Konferensiya id bo'yicha (status va lang query parametrlari).
     */
    public function show(int $id, InputRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);

        $conference = Conference::query()
            ->with(['files', 'images'])
            ->where('id', $id)
            ->where('is_active', $status)
            ->first();

        if ($conference === null) {
            return $this->notFoundResponse('Konferensiya topilmadi', 404);
        }

        return $this->successResponse($this->formatConference($conference, $lang, true));
    }

    /**
     * Konferensiya formati
     */
    private function formatConference(Conference $conference, string $lang, bool $withMedia): array
    {
        $data = [
            'id' => $conference->id,
            'title' => $conference->{'title_'.$lang},
            'description' => $conference->{'description_'.$lang},
            'location' => $conference->{'location_'.$lang},
            'start_date' => $conference->start_date?->format('Y-m-d'),
            'end_date' => $conference->end_date?->format('Y-m-d'),
            'order' => $conference->order,
            'created_at' => $conference->created_at,
            'updated_at' => $conference->updated_at,
        ];

        if (! $withMedia) {
            return $data;
        }

        $data['images'] = $conference->images->map(function (Image $image) {
            return [
                'id' => $image->id,
                'url' => $this->storagePublicUrl($image->image),
            ];
        })->values()->all();

        $data['files'] = $conference->files->map(function (ConferenceFile $file) {
            return [
                'id' => $file->id,
                'name' => $file->displayName(),
                'url' => $this->storagePublicUrl($file->file),
            ];
        })->values()->all();

        return $data;
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
