<?php

namespace App\Http\Requests;

use App\Enums\DepartmentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
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
            'type' => ['required', Rule::in(array_column(DepartmentType::cases(), 'value'))],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
