<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'duties_uz' => ['required', 'string'],
            'duties_ru' => ['required', 'string'],
            'duties_en' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
