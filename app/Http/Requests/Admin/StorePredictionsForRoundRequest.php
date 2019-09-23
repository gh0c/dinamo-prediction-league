<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class StorePredictionsForRoundRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.prediction.store';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'                       => [
                'required',
                'exists:users,id',
            ],
            'predictions.*.game_id'         => [
                'required',
                'exists:games,id',
                Rule::unique('predictions', 'game_id')->where(function ($query) {
                    /** @var $query Builder */
                    $query->where('user_id', $this->input('user_id'));
                }),
            ],
            'predictions.*.home_team_score' => [
                'required',
                'integer',
                'min:0',
            ],
            'predictions.*.away_team_score' => [
                'required',
                'integer',
                'min:0',
            ],

        ];
    }
}
