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
Route::get('/', function () {
    return view('layouts/main-layout');     //To be replaced
});

//USER AUTHENTICATION
Route::get('/login', function(){
    return view('auth/login');
})->name('login');

Route::post('/login','Auth\LoginController@login');

Route::get('/register', function(){
    return view('auth/register');
})->name('register');

Route::post('/logout','Auth\LoginController@logout')->name('logout');
