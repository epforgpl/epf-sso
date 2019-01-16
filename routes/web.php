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
    return redirect(env('EPF_WEBSITE_URL'));
});

Route::get('oauth/authorization', 'Sso\AuthorizationCodeController@handleRequest');
Route::post('oauth/token', 'Sso\AccessTokenController@handleRequest');
Route::get('oauth/userinfo', 'Sso\UserInfoController@handleRequest');
Route::get('oauth/amiloggedin', 'Sso\AmILoggedInController@handleRequest')->middleware('cors');;
Route::get('oauth/jwks', 'Sso\JwksController@getJwks');
Route::get('oauth/logout', 'Sso\LogoutController@logout');

Route::get('oauth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('oauth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
Route::get('oauth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('oauth/google/callback', 'Auth\LoginController@handleGoogleCallback');

Auth::routes();

Route::view('bad-request', 'bad-request');
Route::view('password/reset-success', 'auth.passwords.reset-success');
Route::view('register-success', 'auth.register-success');
Route::view('password/change','auth.passwords.change')->name('password.change');
Route::view('password/change-success','auth.passwords.change-success');
Route::post('password/change','Auth\ChangePasswordController@changePassword')->name('password.change.execute');

Route::get('/o-portalu', 'InfoController@about')->name('about');
Route::get('/dane-osobowe', 'InfoController@personal')->name('personal');
Route::get('/regulamin', 'InfoController@terms')->name('terms');
Route::get('/polityka-prywatnosci', 'InfoController@privacy')->name('privacy');
