<?php

Route::group(['prefix' => 'profile', 'middleware' => ['auth'], 'as' => 'profile.'], function () {
    // Routes are prefixed with /profile        -- e.g. profile/change-password
    // Route names are prefixed with profile.   -- e.g. profile.index

    Route::get('/', [
        'uses' => 'ProfileController@index',
        'as'   => 'index'
    ]);

    Route::get('/change-password', [
        'uses' => 'ProfileController@showChangePasswordForm',
        'as'   => 'change-password.form'
    ]);
    Route::post('/change-password', [
        'uses' => 'ProfileController@changePassword',
        'as'   => 'change-password.submit'
    ]);
});