<?php

namespace App\Http\Requests\Mod;

use App\Http\Requests\BasicPostRequest;

class DeletePlayerRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.mod.player.delete';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'player_id' => 'required|exists:players,id',
        ];
    }
}
