<?php

namespace App\Http\Requests;

class LaboratoryTeamListRequest extends ApiListRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'laboratory_id' => ['sometimes', 'integer', 'exists:laboratories,id'],
        ]);
    }
}
