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
Route::group(['prefix'=>'login'],function(){
	Route::get('','Authentication\LoginController@index')->name('login.index');
	Route::post('','Authentication\LoginController@login')->name('login.submit');
});
Route::group(['prefix'=>'register'],function(){
	Route::get('','Authentication\RegisterController@index')->name('register.index');
	Route::post('','Authentication\RegisterController@register')->name('register.submit');
	Route::post('checkPasswordFormat','Authentication\RegisterController@checkPasswordFormat');
});
Route::get('/', function () {
    return view('contents.dashboard.index');
})->name('home');
Route::get('xendit','Xendit\XenditController@index');
