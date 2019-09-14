<?php

namespace App\Http\Requests\Mod;

use App\Http\Requests\BasicPostRequest;

class UpdateGameRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.mod.game.update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'home_team_id'  => [
                'required',
                'exists:teams,id',
            ],
            'away_team_id'  => [
                'required',
                'exists:teams,id',
            ],
            'round'         => 'required|min:1',
            'datetime_date' => 'required',
            'datetime_time' => 'required',
        ];
    }
}
