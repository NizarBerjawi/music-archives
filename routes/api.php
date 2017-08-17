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
        Route::post('/', 'ArtistsController@store')->name('store');
        Route::get('/{artist}', 'ArtistsController@show')->name('show');
        Route::put('/{artist}', 'ArtistsController@update')->name('update');
        Route::delete('/{artist}', 'ArtistsController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'labels', 'as' => 'labels.'], function() {
        Route::get('/', 'LabelsController@index')->name('index');
        Route::post('/', 'LabelsController@store')->name('store');
        Route::get('/{label}', 'LabelsController@show')->name('show');
        Route::put('/{label}', 'LabelsController@update')->name('update');
        Route::delete('/{label}', 'LabelsController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'recordings', 'as' => 'recordings.'], function() {
        Route::get('/', 'RecordingsController@index')->name('index');
        Route::post('/', 'RecordingsController@store')->name('store');
        Route::get('/{recording}', 'RecordingsController@show')->name('show');
        Route::put('/{recording}', 'RecordingsController@update')->name('update');
        Route::delete('/{recording}', 'RecordingsController@destroy')->name('destroy');
    });
});
