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

// those route are in the course for the Laravel 5.3
// Authentication Routes
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');


// those routes are for my Laravel 5.5   - they work!!! :)


	// Authentication Routes
	Route::get('auth/login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('auth/login', 'Auth\LoginController@login');
	Route::post('auth/logout', 'Auth\LoginController@logout')->name('logout');

	// Registration Routes
	Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('auth/register', 'Auth\RegisterController@register');

	Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
	Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
	Route::get('contact', 'PagesController@getContact');
	Route::post('contact', 'PagesController@postContact');
	Route::get('about', 'PagesController@getAbout');
	Route::get('/', 'PagesController@getIndex');
	Route::resource('posts', 'PostController');

	// Categories
	Route::resource('categories', 'CategoryController', ['except' => ['create']]); // resource gives us all this additional routes for the CRUD functions, except the create function because we have deleted the create functionality
	// 'only' - specifies only the following functionalities

	// Tags
	Route::resource('tags', 'TagController', ['except' => ['create']]);

	// Comments
	Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
