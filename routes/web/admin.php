<?php

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:super_admin,admin'])
    ->group(function () {
        // Routes are prefixed with /admin        -- e.g. admin/seasons/create
        // Route names are prefixed with admin.   -- e.g. admin.competitions.index

        // Controllers within the "App\Http\Controllers\Admin" namespace

        Route::resource('competitions', 'Admin\CompetitionController')->except('show');

        Route::resource('seasons', 'Admin\SeasonController')->except(['show', 'destroy']);
        Route::delete('seasons/{season}')
            ->uses('Admin\SeasonController@destroy')
            ->name('seasons.destroy')
            ->middleware('role:super_admin');

        Route::resource('users', 'Admin\UserController')
            ->middleware('role:super_admin');


        // Dashboard
        Route::get('predictions')
            ->uses('Admin\PredictionController@dashboard')
            ->name('predictions.dashboard');

        // Index
        Route::get('predictions/season/{season}')
            ->uses('Admin\PredictionController@indexForSeason')
            ->name('predictions.seasons.index');

        Route::get('predictions/season/{season}/round/{round}')
            ->uses('Admin\PredictionController@indexForRoundForSeason')
            ->name('predictions.seasons.rounds.index');

        // Aliases
        Route::get('predictions/active-season')
            ->uses('Admin\PredictionController@indexForActiveSeason')
            ->name('predictions.active-season.index');

        Route::get('predictions/active-season/round/{round}')
            ->uses('Admin\PredictionController@indexForRoundForActiveSeason')
            ->name('predictions.active-season.rounds.index');


        // Create
        Route::get('predictions/season/{season}/create')
            ->uses('Admin\PredictionController@createForSeason')
            ->name('predictions.seasons.create');

        Route::get('predictions/season/{season}/round/{round}/create')
            ->uses('Admin\PredictionController@createForRoundForSeason')
            ->name('predictions.seasons.rounds.create');

        // Aliases
        Route::get('predictions/active-season/create')
            ->uses('Admin\PredictionController@createForActiveSeason')
            ->name('predictions.active-season.create');

        Route::get('predictions/active-season/round/{round}/create')
            ->uses('Admin\PredictionController@createForRoundForActiveSeason')
            ->name('predictions.active-season.rounds.create');


        // Store
        Route::post('predictions/season/{season}')
            ->uses('Admin\PredictionController@storeForSeason')
            ->name('predictions.seasons.store');

        Route::post('predictions/season/{season}/round/{round}')
            ->uses('Admin\PredictionController@storeForRoundForSeason')
            ->name('predictions.seasons.rounds.store');


        // Edit
        Route::get('predictions/season/{season}/{prediction}/edit')
            ->uses('Admin\PredictionController@editForSeason')
            ->name('predictions.seasons.edit');

//        Route::post('predictions/season/{season}/round/{round}')
//            ->uses('Admin\PredictionController@storeForRoundForSeason')
//            ->name('predictions.seasons.rounds.store');

        // Alias
        Route::get('predictions/active-season/{prediction}/edit')
            ->uses('Admin\PredictionController@editForActiveSeason')
            ->name('predictions.active-season.edit');


        // Update
        Route::post('predictions/season/{season}/{prediction}')
            ->uses('Admin\PredictionController@updateForSeason')
            ->name('predictions.seasons.update');


        // Destroy
        Route::delete('predictions/{prediction}')
            ->uses('Admin\PredictionController@destroy')
            ->name('predictions.destroy');


        Route::post('predictions/filter-scorers-by-game', 'Admin\PredictionController@filterScorersByGame')
            ->name('predictions.filter.scorers-by-game');

        Route::get('/predictions/set-prediction-outcomes/active-season/round/{round}')
            ->uses('Admin\PredictionController@setPredictionOutcomesForRoundInActiveSeason')
            ->name('predictions.set-prediction-outcomes.active-season.rounds');


        Route::resource('disqualifications', 'Admin\DisqualificationController')->except('show');

    });


