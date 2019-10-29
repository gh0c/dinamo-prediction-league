<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\BasicAjaxRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class StorePlayerRequest extends BasicAjaxRequest
{
    protected $defaultMessageLangKey = 'requests.home.players.store';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'player_name'    => [
                'required',
                'min:2',
                'max:225',
                Rule::unique('players', 'name')->where(function ($query) {
                    /** @var $query Builder */
                    $query->where('team_id', $this->input('player_team_id'));
                }),
            ],
            'player_team_id' => 'exists:teams,id'
        ];
    }
}