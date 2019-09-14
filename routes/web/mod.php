<?php

Route::prefix('mod')
    ->name('mod.')
    ->middleware(['auth', 'role:' . config('roles.names.super_admin') . ',' . config('roles.names.admin') . ',' . config('roles.names.mod')])
    ->group(function () {
        // Routes are prefixed with /mod        -- e.g. mod/players/5/edit
        // Route names are prefixed with mod.   -- e.g. mod.games.index

        // Controllers within the "App\Http\Controllers\Mod" namespace

        Route::resource('games', 'Mod\GameController')->except('show');
        Route::get('games/{game}/result', 'Mod\GameController@editResult')->name('games.result.edit');
        Route::patch('games/{game}/result', 'Mod\GameController@updateResult')->name('games.result.update');

        Route::resource('players', 'Mod\PlayerController')->except('show');

    });