<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;

class DeleteSeasonRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.season.delete';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'season_id' => 'required|exists:seasons,id',
        ];
    }
}
