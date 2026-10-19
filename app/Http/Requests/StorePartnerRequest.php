<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_uz' => ['required', 'string', 'max:600'],
            'name_ru' => ['required', 'string', 'max:600'],
            'name_en' => ['required', 'string', 'max:600'],
            'description_uz' => ['required', 'string', 'max:600'],
            'description_ru' => ['required', 'string', 'max:600'],
            'description_en' => ['required', 'string', 'max:600'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'link' => ['required', 'url', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
