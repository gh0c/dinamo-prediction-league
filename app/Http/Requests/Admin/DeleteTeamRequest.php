<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;

class DeleteTeamRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.team.delete';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'team_id' => 'required|exists:teams,id',
        ];
    }
}
