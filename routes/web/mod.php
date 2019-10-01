<?php

Route::group(['prefix' => 'mod', 'middleware' => ['auth', 'role:super_admin,admin,mod'], 'as' => 'mod.'], function () {
    // Routes are prefixed with /mod        -- e.g. mod/players/5/edit
    // Route names are prefixed with mod.   -- e.g. mod.games.index

    // Controllers within the "App\Http\Controllers\Mod" namespace
    Route::resource('teams', 'Mod\TeamController')->except('show');

    Route::resource('games', 'Mod\GameController')->except('show');
    Route::get('games/{game}/result', [
        'uses' => 'Mod\GameController@editResult',
        'as'   => 'games.result.edit',
    ]);

    Route::patch('games/{game}/result', [
        'uses' => 'Mod\GameController@updateResult',
        'as'   => 'games.result.update',
    ]);


    Route::resource('players', 'Mod\PlayerController')->except('show');

});