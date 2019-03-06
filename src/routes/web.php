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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/fromString', 'PayloadController@fromString');
    Route::get('/useView', 'PayloadController@useView');
    Route::get('/json', 'PayloadController@json');
    Route::get('/jsonp', 'PayloadController@jsonp');
    Route::get('/orgMediaType', 'PayloadController@orgMediaType');
    Route::get('/download', 'PayloadController@download');
    Route::get('/redirect', 'PayloadController@redirect');
});

Route::get('/sse', App\Http\Actions\StreamAction::class);