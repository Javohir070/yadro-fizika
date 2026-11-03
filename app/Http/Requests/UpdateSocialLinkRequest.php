<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'youtube_url' => ['nullable', 'url:http,https', 'max:500'],
            'telegram_url' => ['nullable', 'url:http,https', 'max:500'],
            'instagram_url' => ['nullable', 'url:http,https', 'max:500'],
            'facebook_url' => ['nullable', 'url:http,https', 'max:500'],
        ];
    }
}
