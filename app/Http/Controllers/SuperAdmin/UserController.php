<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Requests\SuperAdmin\ChangeUserPasswordRequest;
use App\Http\Requests\SuperAdmin\UpdateUserRequest;
use App\Models\Users\User;
use App\Models\Users\UserSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('userSetting')->orderBy('username')->get();
        return view('super-admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('super-admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->save();

        $this->setUserSetting($request, $user);

        flash()->success(__('requests.super_admin.user.successful_update', [
            'username' => $user->username,
        ]));
        return redirect()->route('super-admin.users.index');
    }

    /**
     * @param Request $request
     * @param User $user
     */
    protected function setUserSetting(Request $request, User $user)
    {
        $userSettingData = $request->input('userSetting');
        if ($user->userSetting) {
            $userSetting = $user->userSetting;
            $userSetting->fill($userSettingData);
            $userSetting->user()->associate($user);
            $userSetting->save();
        } else {
            $userSetting = new UserSetting();
            $userSetting->fill($userSettingData);
            $userSetting->user()->associate($user);
            $userSetting->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function changePassword(ChangeUserPasswordRequest $request)
    {
        $user = User::find($request->input('user_for_password_change_id'));

        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        return response()->json([
            'message' => __('requests.super_admin.user.successful_password_change', ['username' => $user->username])
        ]);

    }
}
