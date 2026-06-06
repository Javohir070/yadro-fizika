<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLaboratoryRequest extends FormRequest
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
            'details_uz' => ['required', 'string'],
            'details_ru' => ['required', 'string'],
            'details_en' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
            'order' => ['required', 'integer', 'min:0'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
        ];
    }
}
