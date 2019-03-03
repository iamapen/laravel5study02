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

Route::get('/home', function () {
    return view('home');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('auth/register', 'Auth\RegisterController@register');

    Route::get('/auth/login', 'Auth\LoginController@showLoginForm');
    Route::post('/auth/login', 'Auth\LoginController@login');
    Route::get('/auth/logout', 'Auth\LoginController@logout');
});

Route::get('/user', App\Http\Actions\UserIndexAction::class);
Route::post('/user', App\Http\Actions\UserStoreAction::class);
