<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiListRequest;
use App\Models\CouncilMember;
use App\Trait\ApiResponseTrait;
use Illuminate\Support\Facades\Storage;

/**
 * Ilmiy kengash a’zolari. `scientific_council` yuklanadi — kengash sarlavhasi tanlangan tilda qo‘shimcha maydon sifatida.
 */
class CouncilMemberApiController extends Controller
{
    use ApiResponseTrait;

    public function index(ApiListRequest $request)
    {
        $validated = $request->validated();
        $status = (bool) (int) $validated['status'];
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = CouncilMember::query()
            ->with('scientificCouncil')
            ->where('is_active', $status)
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (CouncilMember $row) use ($lang) {
            $council = $row->scientificCouncil;

            return [
                'id' => $row->id,
                'scientific_council_id' => $row->scientific_council_id,
                'council_title' => $council ? $council->{'title_'.$lang} : null,
                'full_name' => $row->{'full_name_'.$lang},
                'position' => $row->{'position_'.$lang},
                'degree' => $row->{'degree_'.$lang},
                'photo_url' => is_null($row->photo) ? null : Storage::url($row->photo),
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
