<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function(){

    Route::post('users/login', 'AuthController@login')->name('login');
    Route::post('users', 'AuthController@register')->name('register');

    Route::get('user', 'UsersController@index')->name('user.index');
    Route::match(['put', 'patch'], 'user', 'UserController@update');

    Route::group(['prefix' => 'artists', 'as' => 'artists.'], function() {
        Route::get('/', 'ArtistsController@index')->name('index');
        Route::get('/create', 'ArtistsController@create')->name('create');
        Route::post('/', 'ArtistsController@store')->name('store');
        Route::get('/{artist}', 'ArtistsController@show')->name('show');
        Route::get('/{artist}/edit', 'ArtistsController@edit')->name('edit');
        Route::put('/{artist}', 'ArtistsController@update')->name('update');
        Route::delete('/{artist}', 'ArtistsController@destroy')->name('destroy');
    });
});
