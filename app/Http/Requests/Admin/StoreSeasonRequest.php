<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;

class StoreSeasonRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.season.store';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|max:3',
            'surname' => 'required'
        ];
    }
}
