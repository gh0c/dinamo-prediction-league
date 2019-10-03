<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\BasicPostRequest;

class ChangePasswordRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.profile.change_password';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed|different:old_password',
        ];
    }
}