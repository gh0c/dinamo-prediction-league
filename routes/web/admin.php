<?php

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:super_admin,admin'], 'as' => 'admin.'], function () {
    // Routes are prefixed with /admin        -- e.g. admin/seasons/create
    // Route names are prefixed with admin.   -- e.g. admin.competitions.index

    // Controllers within the "App\Http\Controllers\Admin" namespace

    Route::resource('competitions', 'Admin\CompetitionController')->except(['show', 'destroy']);

    Route::delete('competitions/{competition}', [
        'uses'       => 'Admin\CompetitionController@destroy',
        'as'         => 'competitions.destroy',
        'middleware' => ['role:super_admin']
    ]);


    Route::resource('seasons', 'Admin\SeasonController')->except(['show', 'destroy']);

    Route::delete('seasons/{season}', [
        'uses'       => 'Admin\SeasonController@destroy',
        'as'         => 'seasons.destroy',
        'middleware' => ['role:super_admin']
    ]);


    // Dashboard
    Route::get('predictions', [
        'uses' => 'Admin\PredictionController@dashboard',
        'as'   => 'predictions.dashboard',
    ]);


    // Index
    Route::get('predictions/season/{season}', [
        'uses' => 'Admin\PredictionController@indexForSeason',
        'as'   => 'predictions.seasons.index',
    ]);

    Route::get('predictions/season/{season}/round/{round}', [
        'uses' => 'Admin\PredictionController@indexForRoundForSeason',
        'as'   => 'predictions.seasons.rounds.index'
    ]);

    // Aliases
    Route::get('predictions/active-season', [
        'uses' => 'Admin\PredictionController@indexForActiveSeason',
        'as'   => 'predictions.active-season.index',
    ]);

    Route::get('predictions/active-season/round/{round}', [
        'uses' => 'Admin\PredictionController@indexForRoundForActiveSeason',
        'as'   => 'predictions.active-season.rounds.index',
    ]);


    // Create
    Route::get('predictions/season/{season}/create', [
        'uses' => 'Admin\PredictionController@createForSeason',
        'as'   => 'predictions.seasons.create',
    ]);

    Route::get('predictions/season/{season}/round/{round}/create', [
        'uses' => 'Admin\PredictionController@createForRoundForSeason',
        'as'   => 'predictions.seasons.rounds.create',
    ]);

    // Aliases
    Route::get('predictions/active-season/create', [
        'uses' => 'Admin\PredictionController@createForActiveSeason',
        'as'   => 'predictions.active-season.create',
    ]);

    Route::get('predictions/active-season/round/{round}/create', [
        'uses' => 'Admin\PredictionController@createForRoundForActiveSeason',
        'as'   => 'predictions.active-season.rounds.create',
    ]);


    // Store
    Route::post('predictions/season/{season}', [
        'uses' => 'Admin\PredictionController@storeForSeason',
        'as'   => 'predictions.seasons.store',
    ]);

    Route::post('predictions/season/{season}/round/{round}', [
        'uses' => 'Admin\PredictionController@storeForRoundForSeason',
        'as'   => 'predictions.seasons.rounds.store',
    ]);


    // Edit
    Route::get('predictions/season/{season}/{prediction}/edit', [
        'uses' => 'Admin\PredictionController@editForSeason',
        'as'   => 'predictions.seasons.edit',
    ]);

    // Alias
    Route::get('predictions/active-season/{prediction}/edit', [
        'uses' => 'Admin\PredictionController@editForActiveSeason',
        'as'   => 'predictions.active-season.edit',
    ]);


    // Update
    Route::post('predictions/season/{season}/{prediction}', [
        'uses' => 'Admin\PredictionController@updateForSeason',
        'as'   => 'predictions.seasons.update',
    ]);


    // Destroy
    Route::delete('predictions/{prediction}', [
        'uses' => 'Admin\PredictionController@destroy',
        'as'   => 'predictions.destroy',
    ]);


    Route::post('predictions/filter-scorers-by-game', [
        'uses' => 'Admin\PredictionController@filterScorersByGame',
        'as'   => 'predictions.filter.scorers-by-game'
    ]);

    Route::get('/predictions/set-prediction-outcomes/active-season/round/{round}', [
        'uses' => 'Admin\PredictionController@setPredictionOutcomesForRoundInActiveSeason',
        'as'   => 'predictions.set-prediction-outcomes.active-season.rounds',
    ]);


    Route::resource('disqualifications', 'Admin\DisqualificationController')->except('show');

});

Route::group(['prefix' => 'super-admin', 'middleware' => ['auth', 'role:super_admin'], 'as' => 'super-admin.'], function () {

    Route::resource('users', 'Admin\UserController');

});




