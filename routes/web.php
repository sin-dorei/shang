<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'StaticPageController@home')->name('home');
Route::get('help', 'StaticPageController@help')->name('help');
Route::get('about', 'StaticPageController@about')->name('about');

Route::get('signup', 'UserController@create')->name('signup');
Route::resource('user', 'UserController');

Route::get('login', 'SessionController@create')->name('login');
Route::post('login', 'SessionController@store')->name('login');
Route::delete('logout', 'SessionController@destroy')->name('logout');

Route::get('signup/confirm/{token}', 'UserController@confirmEmail')->name('confirm_email');
