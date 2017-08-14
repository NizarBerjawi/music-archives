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

Route::get('password-grant-auth', function() {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://music-archives.app/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => config('api.id'),
            'client_secret' => config('api.secret'),
            'username' => 'fritz.stoltenberg@example.com',
            'password' => 'secret',
            'scope' => '',
        ]
    ]);

    $thisUsersTokens = json_decode((string) $response->getBody(), true);

    return $thisUsersTokens;
});
