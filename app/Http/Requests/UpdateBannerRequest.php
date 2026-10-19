<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>|string>
     */
    public function rules(): array
    {
        return [
            'title_uz' => ['sometimes', 'required', 'string', 'max:600'],
            'title_ru' => ['sometimes', 'required', 'string', 'max:600'],
            'title_en' => ['sometimes', 'required', 'string', 'max:600'],
            'description_uz' => ['sometimes', 'required', 'string'],
            'description_ru' => ['sometimes', 'required', 'string'],
            'description_en' => ['sometimes', 'required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
