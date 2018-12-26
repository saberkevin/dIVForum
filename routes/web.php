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
Route::get('/my-forum','ForumController@myForumPage')->name('my-forum');
Route::get('/thread/{id}', 'ForumController@threadPage')->name('view-forum-thread');
Route::get('/thread/edit/{id}/{thread_id}', 'ForumController@threadEditPage')->name('thread-edit-page');
Route::get('/my-forum/edit-forum/{id}','ForumController@editPage')->name('forum-edit-page');
Route::post('/','HomeController@search')->name('search-forum');
Route::post('/thread/{id}', 'ForumController@searchThread')->name('search-forum-thread');
Route::post('/thread/add/{id}', 'ForumController@addThread')->name('add-forum-thread');
Route::post('/thread/edit/{id}/{thread_id}', 'ForumController@updateThread')->name('update-forum-thread');
Route::post('/insert','HomeController@insert')->name('home-insert-forum');
Route::post('/my-forum/edit-forum/{id}', 'ForumController@update')->name('update-forum');
Route::delete('thread/delete/{thread_id}', 'ForumController@deleteThread')->name('delete-forum-thread');

//MASTER FORUM ROUTES
Route::get('/master-forum','ForumController@index')->name('master-forum');
Route::post('/master-forum/close/{id}','ForumController@close')->name('close-forum');
Route::delete('/master-forum/delete/{id}','ForumController@delete')->name('delete-forum');

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

//PROFILE PAGE
Route::get('/profile-page/{id}', 'ProfileController@profilePage')->name('profilePage');
Route::get('/profile-page/edit/{id?}', 'Auth\RegisterController@addEditPage')->name('profileEdit');
Route::get('/profile-page/vote/{id}/{voteBoolean}', 'ProfileController@vote')->name('profileVote');
Route::post('/profile-page/sendMessage/{id}', 'ProfileController@sendMessage')->name('sendMessage');
Route::get('/inbox-page/{id}', 'InboxController@inboxPage')->name('inboxPage');
Route::delete('/inbox-page/delete/{id}', 'InboxController@deleteMessage')->name('deleteMessage');