<?php

Route::get('/', function () {
    return 'admin';
})->name('index');

Route::namespace('Admin')->group(function () {
    // Controllers within the "App\Http\Controllers\Admin" namespace

    Route::resource('seasons', 'SeasonController')->except('show');

    Route::resource('users', 'UserController')
        ->middleware('role:' . config('roles.names.super_admin'));
});


