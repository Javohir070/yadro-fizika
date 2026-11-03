<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Trait\ApiResponseTrait;

class SocialLinkApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Ijtimoiy tarmoq linklari.
     */
    public function index()
    {
        $row = SocialLink::query()
            ->select('id', 'youtube_url', 'telegram_url', 'instagram_url', 'facebook_url', 'created_at', 'updated_at')
            ->first();

        if ($row === null) {
            return $this->notFoundResponse('Ijtimoiy tarmoq linklari topilmadi', 404);
        }

        return $this->successResponse($row);
    }
}
