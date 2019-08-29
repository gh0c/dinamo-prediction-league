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

Route::get('/zimbabve', function () {
    flash()->info('info 1')->important();
    flash()->warning('info 2');
    return redirect('/vanuatu');
})->name('index.zimbabve');

Route::get('/vanuatu', function () {
    foreach (session('flash_notification', collect())->toArray() as $message) {
        dump($message);
    }
})->name('index.vanuatu');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Require admin routes
include_once __DIR__ . '/web/admin.php';
include_once __DIR__ . '/web/mod.php';