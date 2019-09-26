<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/results/{season}/round/{round}', 'ResultsController@showRoundResults')
    ->name('results.round');

Route::get('/results/overall', 'ResultsController@showOverallResultsForActiveSeason')
    ->name('results.overall');


Auth::routes(['reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// Require admin routes
include_once __DIR__ . '/web/admin.php';
include_once __DIR__ . '/web/mod.php';