<?php

namespace App\Http\Requests\Mod;

use App\Http\Requests\BasicPostRequest;

class DeleteGameRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.mod.game.delete';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_id' => 'required|exists:games,id',
        ];
    }
}
