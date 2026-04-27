<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Bitta yozuv qaytaradigan APIlar uchun (first()).
 * Ro‘yxat + pagination uchun `ApiListRequest` ishlating.
 */
class InputRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'sometimes|in:1,0',
            'lang' => 'sometimes|in:uz,ru,en',
        ];
    }

    protected function prepareForValidation(): void
    {
        if (! $this->has('status')) {
            $this->merge(['status' => 1]);
        }

        if (! $this->has('lang')) {
            $this->merge(['lang' => 'uz']);
        }
    }
}
