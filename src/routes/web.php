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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register', 'Register\\RegisterAction')->name('register');
Route::get('/register/callback', 'Register\\CallbackAction');

Route::get('/users/{id}', 'User\RetrieveAction');
Route::get('/users/edit/{id}', 'User\EditAction');
