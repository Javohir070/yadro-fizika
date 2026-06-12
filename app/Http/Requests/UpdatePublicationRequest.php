<?php

namespace App\Http\Requests;

use App\Enums\PublicationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePublicationRequest extends FormRequest
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
            'type' => ['required', Rule::in(array_column(PublicationType::cases(), 'value'))],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'is_active' => ['required', 'boolean'],
            'order' => ['required', 'integer', 'min:0'],
        ];
    }
}
