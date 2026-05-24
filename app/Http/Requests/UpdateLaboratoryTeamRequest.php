<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLaboratoryTeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $nullableFields = [
            'degree_uz',
            'degree_ru',
            'degree_en',
            'google_scholar',
            'web_of_science',
            'scopus',
            'researchgate',
            'orcid',
        ];

        $normalized = [];
        foreach ($nullableFields as $field) {
            $normalized[$field] = $this->filled($field) ? $this->input($field) : null;
        }

        $this->merge($normalized);
    }

    public function rules(): array
    {
        return [
            'full_name_uz' => ['required', 'string', 'max:600'],
            'full_name_ru' => ['required', 'string', 'max:600'],
            'full_name_en' => ['required', 'string', 'max:600'],
            'position_uz' => ['required', 'string', 'max:600'],
            'position_ru' => ['required', 'string', 'max:600'],
            'position_en' => ['required', 'string', 'max:600'],
            'degree_uz' => ['nullable', 'string'],
            'degree_ru' => ['nullable', 'string'],
            'degree_en' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'google_scholar' => ['nullable', 'url', 'max:500'],
            'web_of_science' => ['nullable', 'url', 'max:500'],
            'scopus' => ['nullable', 'url', 'max:500'],
            'researchgate' => ['nullable', 'url', 'max:500'],
            'orcid' => ['nullable', 'url', 'max:500'],
            'type' => ['required', 'in:0,1'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
