<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ChangePasswordRequest;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function showChangePasswordForm()
    {
        return view('profile.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $currentPassword = Auth::user()->password;

        if (!(\Hash::check($request->input('old_password'), $currentPassword))) {
            flash()->error(__('requests.profile.password_change_mismatch'))->important();
            return back()->withInput();
        }

        $user = Auth::user();
        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        flash()->success(__('requests.profile.successful_password_change'));
        return redirect()->route('profile.index');

    }
}