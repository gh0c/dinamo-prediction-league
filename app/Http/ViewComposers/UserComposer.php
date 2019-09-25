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

    public function inputDisqualificationReasons(View $view)
    {
        $inputDisqualificationReasons = [
            ''           => __('forms.admin.disqualifications.reason.placeholder'),
            'inactivity' => __('models.predictions.disqualification_reason._values.inactivity')
        ];

        $view->with([
            'inputDisqualificationReasons' => $inputDisqualificationReasons,
        ]);
    }
}