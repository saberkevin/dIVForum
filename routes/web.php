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

//LANDING PAGE
Route::get('/', 'RoutesController@home');

//USER AUTHENTICATION
Route::get('/login', 'RoutesController@login')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::get('/register', 'RoutesController@register')->name('register');
Route::post('/logout','Auth\LoginController@logout')->name('logout');
Route::post('/register/add', 'Auth\RegisterController@createUser')->name('registerUser');


