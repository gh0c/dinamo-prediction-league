<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;
use Illuminate\Validation\Rule;

/**
 * @property \App\Models\Games\Competition $competition
 **/
class UpdateCompetitionRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.competition.update';

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
                Rule::unique('competitions', 'name')->where('sport', $this->input('sport'))->ignore($this->competition->id)
            ],
            'sport' => 'required|in:football,futsal'
        ];
    }
}
