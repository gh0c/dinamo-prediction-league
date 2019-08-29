<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;
use Illuminate\Validation\Rule;

class StoreCompetitionRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.competition.store';

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
                Rule::unique('competitions', 'name')->where('sport', $this->input('sport'))
            ],
            'sport' => 'required|in:football,futsal'
        ];
    }
}
