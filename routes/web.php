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
Route::group(['prefix'=>'login', 'middleware' => ['isGuest']],function(){
	Route::get('','Authentication\LoginController@index')->name('login.index');
	Route::post('','Authentication\LoginController@login')->name('login.submit');
});

Route::group(['prefix'=>'register', 'middleware' => ['isGuest']],function(){
	Route::get('','Authentication\RegisterController@index')->name('register.index');
	Route::post('','Authentication\RegisterController@register')->name('register.submit');
	Route::post('checkPasswordFormat','Authentication\RegisterController@checkPasswordFormat');
});

Route::group(['prefix'=>'authenticator', 'middleware' => ['isUser']],function(){
	Route::get('','Authentication\LoginGoogleController@index')->name('login.author')->middleware('AuthenticateUser');
	Route::post('','Authentication\LoginGoogleController@login')->name('submitlogin.author')->middleware('AuthenticateUser');
	Route::get('register','Authentication\RegisterGoogleController@index')->name('register.author')->middleware('AuthenticateGuest');
	Route::post('register','Authentication\RegisterGoogleController@submitRegister')->name('submit.author')->middleware('AuthenticateGuest');
});

Route::group(['prefix'=>'', 'middleware' => ['isUser']],function(){
	Route::get('','Dashboard\DashboardController@index')->name('home');
});

Route::group(['prefix'=>'cloud', 'middleware' => ['isUser']],function(){
	Route::get('','Cloud\CloudController@index')->name('cloud.index');
});

Route::group(['prefix'=>'command', 'middleware' => ['isUser','AuthenticatorAuth']],function(){
	Route::get('','Command\CommandController@index')->name('command.index');
	Route::post('','Command\CommandController@submitcommand')->name('command.submit');
	Route::post('/login','Command\CommandController@login')->name('command.login');
});

Route::get('logout','Authentication\LoginController@logout')->name('logout');

Route::get('xendit','Xendit\XenditController@index');
