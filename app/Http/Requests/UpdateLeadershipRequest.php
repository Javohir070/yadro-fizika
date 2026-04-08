<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadershipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department_id' => ['required', 'exists:departments,id'],
            'full_name_uz' => ['required', 'string', 'max:255'],
            'full_name_ru' => ['required', 'string', 'max:255'],
            'full_name_en' => ['required', 'string', 'max:255'],
            'position_uz' => ['required', 'string', 'max:1000'],
            'position_ru' => ['required', 'string', 'max:1000'],
            'position_en' => ['required', 'string', 'max:1000'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
