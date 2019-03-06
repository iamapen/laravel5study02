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
});

Route::get('/articles/new', App\Http\Actions\Article\ArticleNewAction::class);
Route::post('/articles', App\Http\Actions\Article\ArticleAddAction::class);
