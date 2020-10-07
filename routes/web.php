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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/post/{id}', 'WelcomeController@post')->name('post.single');
Route::get('/post/category/{category_id}', 'WelcomeController@byCategory')->name('posts.category');
Route::get('/post/user/{user_id}', 'WelcomeController@byAuthor')->name('posts.author');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/categories', 'CategoryController');
Route::resource('/posts', 'PostController');