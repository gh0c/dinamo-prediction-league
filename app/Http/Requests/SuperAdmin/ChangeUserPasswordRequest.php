<?php

namespace App\Http\Requests\SuperAdmin;

use App\Http\Requests\BasicAjaxRequest;

class ChangeUserPasswordRequest extends BasicAjaxRequest
{
    protected $defaultMessageLangKey = 'requests.super_admin.user.change_password';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_for_password_change_id' => 'required|exists:users,id',
            'new_password'                => 'required|string|min:6|confirmed',
        ];
    }
}