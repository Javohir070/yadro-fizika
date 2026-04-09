<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouncilMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'scientific_council_id' => ['required', 'exists:scientific_councils,id'],
            'full_name_uz' => ['required', 'string', 'max:255'],
            'full_name_ru' => ['required', 'string', 'max:255'],
            'full_name_en' => ['required', 'string', 'max:255'],
            'position_uz' => ['required', 'string', 'max:1000'],
            'position_ru' => ['required', 'string', 'max:1000'],
            'position_en' => ['required', 'string', 'max:1000'],
            'degree_uz' => ['required', 'string', 'max:255'],
            'degree_ru' => ['required', 'string', 'max:255'],
            'degree_en' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'order' => ['required', 'integer', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
