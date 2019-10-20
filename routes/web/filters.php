<?php

Route::group(['prefix' => 'filters', 'middleware' => ['auth'], 'as' => 'filters.'], function () {

    Route::post('/filter-scorers-by-game', [
        'uses' => 'FilteringController@filterScorersByGame',
        'as'   => 'filter.scorers-by-game'
    ]);

});
