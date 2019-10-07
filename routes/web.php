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
})->name('welcome');


Route::get('/results/{season}/round/{round}', [
    'uses' => 'ResultsController@showRoundResults',
    'as'   => 'results.round',
]);

Route::get('/results/overall', [
    'uses' => 'ResultsController@showOverallResultsForActiveSeason',
    'as'   => 'results.overall',
]);


Auth::routes(['reset' => false]);

Route::get('/home', [
    'uses'       => 'HomeController@index',
    'middleware' => ['auth'],
    'as'         => 'home'
]);

// Require profile routes
include_once __DIR__ . '/web/profile.php';

// Require admin routes
include_once __DIR__ . '/web/admin.php';
include_once __DIR__ . '/web/mod.php';