<?php

namespace App\Http\Requests\SuperAdmin;

use App\Http\Requests\BasicPostRequest;
use App\Models\Users\User;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\SuperAdmin
 * @property User $user
 */
class UpdateUserRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.super_admin.user.update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users,username,' . $this->user->id,
            'email'    => 'required|email|unique:users,email,' . $this->user->id,
        ];
    }
}