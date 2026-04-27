<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Models\Stat;
use App\Trait\ApiResponseTrait;

class StatApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Statistika bloklari ro'yxati.
     */
    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Stat::query()
            ->where('is_active', $status)
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Stat $stat) use ($lang) {
            return [
                'id' => $stat->id,
                'title' => $stat->{'title_'.$lang},
                'value' => $stat->value,
                'suffix' => $stat->suffix,
                'display_value' => $stat->value.($stat->suffix ?? ''),
                'order' => $stat->order,
                'created_at' => $stat->created_at,
                'updated_at' => $stat->updated_at,
            ];
        });

        return $this->paginatedSuccessResponse($paginator);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
