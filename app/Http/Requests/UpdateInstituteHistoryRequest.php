<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInstituteHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'details_uz' => ['required', 'string'],
            'details_ru' => ['required', 'string'],
            'details_en' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
