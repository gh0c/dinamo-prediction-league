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
            'name'             => 'required|min:3|max:225|unique:seasons,name',
            'jokers_available' => 'required|integer|min:0'
        ];
    }
}
