<?php

namespace App\Http\Requests\Mod;

use App\Http\Requests\BasicPostRequest;
use Illuminate\Validation\Rule;

class StorePlayerRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.mod.player.store';

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
            ],
        ];
    }
}
