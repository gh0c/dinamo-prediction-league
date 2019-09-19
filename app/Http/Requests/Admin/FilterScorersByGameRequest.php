<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicAjaxRequest;

class FilterScorersByGameRequest extends BasicAjaxRequest
{
    protected $defaultMessageLangKey = 'requests.admin.prediction.filter.scorers_by_game';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_id' => 'present',
        ];
    }
}
