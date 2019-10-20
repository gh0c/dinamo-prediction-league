<?php

namespace App\Http\Requests\Filters;

use App\Http\Requests\BasicAjaxRequest;

class FilterScorersByGameRequest extends BasicAjaxRequest
{
    protected $defaultMessageLangKey = 'requests.filters.filter.scorers_by_game';

    public function rules()
    {
        return [
            'game_id' => 'present',
        ];
    }
}