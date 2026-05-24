<?php

namespace App\Http\Requests;

class WorkActivityListRequest extends ApiListRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'laboratory_team_id' => ['sometimes', 'integer', 'exists:laboratory_teams,id'],
        ]);
    }
}
