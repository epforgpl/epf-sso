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

Route::get('oauth/authorization', 'Sso\AuthorizationCodeController@handleRequest');
Route::post('oauth/token', 'Sso\AccessTokenController@handleRequest');
Route::get('oauth/userinfo', 'Sso\UserInfoController@handleRequest');
Route::post('oauth/ssologin', 'Sso\SsoLoginController@authenticate');
Route::get('oauth/amiloggedin', 'Sso\AmILoggedInController@handleRequest');
Route::get('oauth/jwks', 'Sso\JwksController@getJwks');

Route::get('oauth/google', 'Sso\MyLoginController@redirectToGoogle');
Route::get('oauth/google/callback', 'Sso\MyLoginController@handleGoogleCallback');

Route::get('/', function () {
    return view('welcome');
});
