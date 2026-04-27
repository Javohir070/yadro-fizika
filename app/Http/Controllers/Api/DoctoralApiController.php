<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Models\Doctoral;
use App\Trait\ApiResponseTrait;

class DoctoralApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Doktorantura mutaxassisliklari ro‘yxati.
     */
    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = Doctoral::query()
            ->where('is_active', $status)
            ->orderBy('name_uz')
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (Doctoral $row) use ($lang) {
            return [
                'id' => $row->id,
                'name' => $row->{'name_' . $lang},
                'code' => $row->code,
                'file' => $this->storagePublicUrl($row->file),
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
