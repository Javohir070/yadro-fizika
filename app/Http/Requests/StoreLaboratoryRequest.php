<?php

namespace App\Http\Requests;

use App\Enums\LaboratoryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLaboratoryRequest extends FormRequest
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
            'type' => ['required', Rule::in(array_column(LaboratoryType::cases(), 'value'))],
            'details_uz' => ['required', 'string'],
            'details_ru' => ['required', 'string'],
            'details_en' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
            'order' => ['required', 'integer', 'min:0'],
        ];
    }
}
