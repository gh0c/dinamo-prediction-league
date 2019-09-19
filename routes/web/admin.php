<?php

Route::get('/', function () {
    return 'admin';
})->name('index');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:' . config('roles.names.super_admin') . ',' . config('roles.names.admin')])
    ->group(function () {
        // Routes are prefixed with /admin        -- e.g. admin/seasons/create
        // Route names are prefixed with admin.   -- e.g. admin.teams.index

        // Controllers within the "App\Http\Controllers\Admin" namespace

        Route::resource('competitions', 'Admin\CompetitionController')->except('show');

        Route::resource('seasons', 'Admin\SeasonController')->except('show');

        Route::resource('teams', 'Admin\TeamController')->except('show');

        Route::resource('users', 'Admin\UserController')
            ->middleware('role:' . config('roles.names.super_admin'));

        Route::resource('predictions', 'Admin\PredictionController')->except('show');
        Route::post('predictions/filter-scorers-by-game', 'Admin\PredictionController@filterScorersByGame')
            ->name('predictions.filter.scorers-by-game');

        Route::get('/pred/test', function () {
            $predictions = new App\Repositories\Predictions();
            $predictions->setPredictionOutcomesForRoundInActiveSeason(7);
        });

    });


