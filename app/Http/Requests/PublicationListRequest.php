<?php

namespace App\Http\Requests;

use App\Enums\PublicationType;
use Illuminate\Validation\Rule;

class PublicationListRequest extends ApiListRequest
{
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'type' => ['sometimes', Rule::in(array_column(PublicationType::cases(), 'value'))],
        ];
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();

        if (! $this->has('type')) {
            $this->merge(['type' => PublicationType::ScientificArticle->value]);
        }
    }
}
