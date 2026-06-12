<?php

namespace App\Http\Requests;

use App\Enums\LaboratoryType;
use Illuminate\Validation\Rule;

class LaboratoryListRequest extends ApiListRequest
{
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'type' => ['sometimes', Rule::in(array_column(LaboratoryType::cases(), 'value'))],
        ];
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();

        if (! $this->has('type')) {
            $this->merge(['type' => LaboratoryType::Laboratory->value]);
        }
    }
}
