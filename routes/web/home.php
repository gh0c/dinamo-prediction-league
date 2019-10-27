<?php

Route::group(['prefix' => 'home', 'middleware' => ['auth'], 'as' => 'home.'], function () {

    Route::get('/', [
        'uses' => 'HomeController@index',
        'as'   => 'index'
    ]);

    // Create
    Route::get('predictions/create/game/{game}', [
        'uses' => 'HomeController@createPrediction',
        'as'   => 'predictions.active-season.create',
    ]);

    Route::get('predictions/round/{round}/create', [
        'uses' => 'HomeController@createPredictionsForRound',
        'as'   => 'predictions.active-season.rounds.create',
    ]);

    // Store
    Route::post('predictions/', [
        'uses' => 'HomeController@storePrediction',
        'as'   => 'predictions.store',
    ]);

    Route::post('predictions/round/{round}', [
        'uses' => 'HomeController@storePredictionsForRound',
        'as'   => 'predictions.rounds.store',
    ]);

    // Edit
    Route::get('predictions/{prediction}/edit', [
        'uses' => 'HomeController@editPrediction',
        'as'   => 'predictions.edit',
    ]);

    // Update
    Route::patch('predictions/{prediction}', [
        'uses' => 'HomeController@updatePrediction',
        'as'   => 'predictions.update',
    ]);

    // Destroy
    Route::delete('predictions/{prediction}', [
        'uses' => 'HomeController@destroyPrediction',
        'as'   => 'predictions.destroy',
    ]);

});