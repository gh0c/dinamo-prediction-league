<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;

class UpdatePredictionRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.prediction.update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'         => [
                'required',
                'exists:users,id',
            ],
            'game_id'         => [
                'required',
                'exists:games,id',
            ],
            'home_team_score' => [
                'required',
                'integer',
                'min:0',
            ],
            'away_team_score' => [
                'required',
                'integer',
                'min:0',
            ],
        ];
    }
}
