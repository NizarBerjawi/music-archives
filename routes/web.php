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

Route::group(['prefix' => 'artists', 'as' => 'artists.'], function() {
    Route::get('/', 'ArtistsController@index')->name('index');
    Route::get('/create', 'ArtistsController@create')->name('create');
    Route::post('/', 'ArtistsController@store')->name('store');
    Route::get('/{artist}', 'ArtistsController@show')->name('show');
    Route::get('/{artist}/edit', 'ArtistsController@edit')->name('edit');
    Route::put('/{artist}', 'ArtistsController@update')->name('update');
});
