<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouncilMemberRequest;
use App\Models\CouncilMember;
use App\Trait\ApiResponseTrait;

class CouncilMemberApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;

    /**
     * Ilmiy kengash a’zolari haqida ma’lumot.
     */
    public function index(CouncilMemberRequest $request)
    {
        $validated = $request->validated();
        // $status = (bool) (int) $validated['status'] ?? 1;
        $lang = $this->resolveLang($validated['lang']);
        $perPage = (int) $validated['per_page'];

        $paginator = CouncilMember::query()
            ->with('scientificCouncil')
            // ->where('scientific_council_id', (int) $validated['scientific_council_id'])
            ->where('is_active', 1)
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate($perPage);

        $paginator->getCollection()->transform(function (CouncilMember $row) use ($lang) {
            return [
                'id' => $row->id,
                'scientific_council_id' => $row->scientific_council_id,
                'fullname' => $row->{'full_name_'.$lang},
                'position' => $row->{'position_'.$lang},
                'degree' => $row->{'degree_'.$lang},
                'photo' => is_null($row->photo) ? null : $this->storagePublicUrl($row->photo),
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
