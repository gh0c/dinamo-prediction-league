<?php

Route::get('/results/{season}/round/{round}', [
    'uses' => 'ResultsController@showRoundResults',
    'as'   => 'results.round',
]);

Route::get('/results/overall', [
    'uses' => 'ResultsController@showOverallResultsForActiveSeason',
    'as'   => 'results.overall',
]);