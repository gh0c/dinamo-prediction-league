<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;

/**
 * @property \App\Models\Games\Season $season
 **/
class UpdateSeasonRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.season.update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required|min:3|max:225|unique:seasons,name,' . $this->season->id,
            'jokers_available' => 'required|integer|min:0'
        ];
    }
}
