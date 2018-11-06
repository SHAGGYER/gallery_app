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
    return view('app');
});

Route::resource('album', 'AlbumController')->only([
    'index', 'show', 'update', 'destroy', 'store'
]);;

Route::get('photo/download/{id}', 'PhotoController@download');
Route::resource('photo', 'PhotoController')->only([
    'update', 'destroy', 'store'
]);;

Route::prefix('auth')->group(function () {
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::post('logout', 'UserController@logout');
    Route::post('init', 'UserController@init');
});