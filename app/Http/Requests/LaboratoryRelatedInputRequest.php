<?php

namespace App\Http\Requests;

class LaboratoryRelatedInputRequest extends InputRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'laboratory_id' => ['required', 'integer', 'exists:laboratories,id'],
        ]);
    }
}
