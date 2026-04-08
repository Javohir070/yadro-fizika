<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScientificCouncilRequest extends FormRequest
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
            'council_duties_uz' => ['required', 'string'],
            'council_duties_ru' => ['required', 'string'],
            'council_duties_en' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
