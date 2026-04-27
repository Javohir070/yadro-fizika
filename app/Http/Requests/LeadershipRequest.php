<?php

namespace App\Http\Requests;

use App\Enums\DepartmentType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LeadershipRequest extends FormRequest
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
            'lang' => 'sometimes|in:uz,ru,en',
            'page' => 'sometimes|integer|min:1',
            'per_page' => 'sometimes|integer|min:1|max:50',
            'type' => 'sometimes|in:'.implode(',', array_column(DepartmentType::cases(), 'value')),
        ];
    }

    protected function prepareForValidation(): void
    {
        if (! $this->has('lang')) {
            $this->merge(['lang' => 'uz']);
        }
        if (! $this->has('page')) {
            $this->merge(['page' => 1]);
        }
        if (! $this->has('per_page')) {
            $this->merge(['per_page' => 15]);
        }
    }
}
