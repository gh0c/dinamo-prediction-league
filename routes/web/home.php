<?php

Route::group(['prefix' => 'home', 'middleware' => ['auth'], 'as' => 'home.'], function () {

    Route::get('/', [
        'uses' => 'HomeController@index',
        'as'   => 'index'
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

});