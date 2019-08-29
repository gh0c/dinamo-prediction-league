<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;
use Illuminate\Validation\Rule;

/**
 * @property \App\Models\Team $team
 **/
class UpdateTeamRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.team.update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => [
                'required',
                'min:2',
                'max:225',
                Rule::unique('teams', 'name')->where('sport', $this->input('sport'))->ignore($this->team->id)
            ],
            'sport' => 'required|in:football,futsal'
        ];
    }
}
