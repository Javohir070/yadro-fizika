<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctoralRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_uz' => ['required', 'string', 'max:1000'],
            'name_ru' => ['required', 'string', 'max:1000'],
            'name_en' => ['required', 'string', 'max:1000'],
            'code' => ['required', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
