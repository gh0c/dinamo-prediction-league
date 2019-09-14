<?php

namespace App\Http\Requests\Mod;

use App\Http\Requests\BasicPostRequest;

class UpdateGameResultRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.mod.game.result.update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'result.home_team_score' => [
                'required',
                'integer',
                'min:0',
            ],
            'result.away_team_score' => [
                'required',
                'integer',
                'min:0',
            ],
            'goal_scorers.*.player_id' => 'required|exists:players,id'
        ];
    }

    public function validationData()
    {
        return $this->except('goal_scorers.x');
    }
}
