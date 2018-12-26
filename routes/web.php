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
Route::get('/', 'HomeController@index')->name('home');

//USER AUTHENTICATION
Route::get('/login', 'RoutesController@loginPage')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::get('/register/', 'Auth\RegisterController@addEditPage')->name('register');
Route::post('/logout','Auth\LoginController@logout')->name('logout');
Route::post('/add-update-user/{routeName}/{id?}', 'Auth\RegisterController@addUpdateUser')->name('addUpdateUser');
Route::post('/logout','Auth\LoginController@logout')->name('logout');

//FORUM ROUTES
Route::get('/insert','HomeController@insertPage')->name('home-insert-page');
Route::post('/','HomeController@search')->name('search-forum');
Route::post('/insert','HomeController@insert')->name('home-insert-forum');

//MASTER CATEGORY ROUTES
Route::get('/master-category','CategoryController@index')->name('master-category');
Route::get('/master-category/edit/{id}','CategoryController@editPage')->name('edit-master-category');
Route::post('/master-category','CategoryController@insert')->name('add-category');
Route::post('/master-category/edit/{id}','CategoryController@update')->name('update-category');
Route::delete('/master-category/delete/{id}','CategoryController@delete')->name('delete-category');

//MASTER USER
Route::get('/master-user/', 'UserController@masterUserPage')->name('masterUser');
Route::get('/master-user/add', 'Auth\RegisterController@addEditPage')->name('addUser');
Route::get('/master-user/update/{id?}','Auth\RegisterController@addEditPage')->name('updateUserPage');
Route::delete('/master-user/delete/{id}','Auth\RegisterController@deleteUser')->name('deleteUser');