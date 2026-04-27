<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\ResolvesPublicMediaUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\InputRequest;
use App\Models\About;
use App\Trait\ApiResponseTrait;
use Illuminate\Support\Facades\Storage;

class AboutApiController extends Controller
{
    use ApiResponseTrait;
    use ResolvesPublicMediaUrl;
    /**
     * About
     */
    public function index(InputRequest $request)
    {
        $validated = $request->validated();
        $status = (int) ($validated['status'] ?? 1);
        $lang = $this->resolveLang($validated['lang'] ?? 'uz');

        $about = About::query()
            ->selectRaw('id, content_'.$lang.' as content, image, created_at, updated_at')
            ->where('is_active', $status)
            ->first();

        if ($about === null) {
            return $this->notFoundResponse('About ma\'lumotlari topilmadi', 404);
        }

        $payload = $about->toArray();
        $payload['image'] = $this->storagePublicUrl($about->image);

        return $this->successResponse($payload);
    }

    private function resolveLang(string $lang): string
    {
        return in_array($lang, ['uz', 'ru', 'en'], true) ? $lang : 'uz';
    }
}
