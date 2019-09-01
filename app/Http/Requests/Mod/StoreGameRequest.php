<?php

namespace App\Http\Requests\Mod;

use App\Http\Requests\BasicPostRequest;
use Illuminate\Validation\Rule;

class StoreGameRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.mod.game.store';

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
