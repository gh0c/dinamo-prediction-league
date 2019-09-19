<?php

namespace App\Http\ViewComposers;

use App\Models\Users\User;
use Illuminate\Contracts\View\View;

class UserComposer
{
    public function inputUsers(View $view)
    {
        $inputUsers = User::orderBy('username')->pluck('username', 'id')->all();

        $inputUsers = ['' => __('forms.admin.predictions.user.placeholder')] + $inputUsers;

        $view->with([
            'inputUsers' => $inputUsers,
        ]);
    }
}