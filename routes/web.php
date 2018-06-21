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
Route::get('oauth/amiloggedin', 'Sso\AmILoggedInController@handleRequest')->middleware('cors');;
Route::get('oauth/jwks', 'Sso\JwksController@getJwks');

Route::get('oauth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('oauth/google/callback', 'Auth\LoginController@handleGoogleCallback');

Auth::routes();

Route::view('bad-request', 'bad-request');
Route::view('password/reset-success', 'auth.passwords.reset-success');
Route::view('register-success', 'auth.register-success');
Route::view('password/change','auth.passwords.change');
Route::post('password/change','Auth\ChangePasswordController@changePassword')->name('changePassword');
