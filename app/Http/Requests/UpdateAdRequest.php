<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdRequest extends FormRequest
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
            'title_uz' => ['required', 'string', 'max:600'],
            'title_ru' => ['required', 'string', 'max:600'],
            'title_en' => ['required', 'string', 'max:600'],
            'description_uz' => ['required', 'string'],
            'description_ru' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
