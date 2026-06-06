<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConferenceRequest extends FormRequest
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
            'title_uz' => ['required', 'string', 'max:1000'],
            'title_ru' => ['required', 'string', 'max:1000'],
            'title_en' => ['required', 'string', 'max:1000'],
            'description_uz' => ['required', 'string'],
            'description_ru' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'order' => ['required', 'integer', 'min:0'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'location_uz' => ['required', 'string', 'max:1000'],
            'location_ru' => ['required', 'string', 'max:1000'],
            'location_en' => ['required', 'string', 'max:1000'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
