<?php

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:super_admin,admin'])
    ->group(function () {
        // Routes are prefixed with /admin        -- e.g. admin/seasons/create
        // Route names are prefixed with admin.   -- e.g. admin.teams.index

        // Controllers within the "App\Http\Controllers\Admin" namespace

        Route::resource('competitions', 'Admin\CompetitionController')->except('show');

        Route::resource('seasons', 'Admin\SeasonController')->except(['show', 'destroy']);
        Route::delete('seasons/{season}')
            ->uses('Admin\SeasonController@destroy')
            ->name('seasons.destroy')
            ->middleware('role:super_admin');

        Route::resource('teams', 'Admin\TeamController')->except('show');

        Route::resource('users', 'Admin\UserController')
            ->middleware('role:super_admin');

        Route::resource('predictions', 'Admin\PredictionController')->except('show');

        Route::get('predictions/active-season/round/{round}')
            ->uses('Admin\PredictionController@indexForRound')
            ->name('predictions.index-for-round');
        Route::get('predictions/active-season/round/{round}/create')
            ->uses('Admin\PredictionController@createForRound')
            ->name('predictions.create-for-round');
        Route::post('predictions/active-season/round/{round}/')
            ->uses('Admin\PredictionController@storeForRound')
            ->name('predictions.store-for-round');

        Route::post('predictions/filter-scorers-by-game', 'Admin\PredictionController@filterScorersByGame')
            ->name('predictions.filter.scorers-by-game');

        Route::get('/predictions/set-prediction-outcomes/active-season/round/{round}')
            ->uses('Admin\PredictionController@setPredictionOutcomesForRoundInActiveSeason')
            ->name('predictions.set-prediction-outcomes.active-season.rounds');


        Route::resource('disqualifications', 'Admin\DisqualificationController')->except('show');

    });


