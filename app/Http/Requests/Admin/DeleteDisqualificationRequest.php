<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;

class DeleteDisqualificationRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.disqualification.delete';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'disqualification_id' => 'required|exists:disqualifications,id',
        ];
    }
}
