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

    Route::post('users/login', 'AuthController@login');
    Route::post('users', 'AuthController@register');

    Route::get('users', 'UsersController@index');
    Route::match(['put', 'patch'], 'user', 'UsersController@update');

    Route::group(['prefix' => 'artists'], function() {
        Route::get('/', 'ArtistsController@index');
        Route::post('/', 'ArtistsController@store');
        Route::get('/{artist}', 'ArtistsController@show');
        Route::put('/{artist}', 'ArtistsController@update');
        Route::delete('/{artist}', 'ArtistsController@destroy');
    });

    Route::group(['prefix' => 'labels'], function() {
        Route::get('/', 'LabelsController@index');
        Route::post('/', 'LabelsController@store');
        Route::get('/{label}', 'LabelsController@show');
        Route::put('/{label}', 'LabelsController@update');
        Route::delete('/{label}', 'LabelsController@destroy');
    });

    Route::group(['prefix' => 'recordings'], function() {
        Route::get('/', 'RecordingsController@index');
        Route::post('/', 'RecordingsController@store');
        Route::get('/{recording}', 'RecordingsController@show');
        Route::put('/{recording}', 'RecordingsController@update');
        Route::delete('/{recording}', 'RecordingsController@destroy');
    });
});
