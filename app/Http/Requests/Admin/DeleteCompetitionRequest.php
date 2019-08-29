<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;

class DeleteCompetitionRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.competition.delete';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'competition_id' => 'required|exists:competitions,id',
        ];
    }
}
