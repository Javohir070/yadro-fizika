<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_uz' => ['required', 'string', 'max:1000'],
            'title_ru' => ['required', 'string', 'max:1000'],
            'title_en' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
