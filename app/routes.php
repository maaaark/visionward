<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::resource('categories', 'CategoriesController');
Route::resource('champions', 'ChampionsController');
Route::get('/', 'PostController@index');
Route::get('/login', 'AdminController@index');
Route::post('login', array('uses' => 'AdminController@doLogin'));

// News
Route::get('/news/{id}', 'PostController@show');


Route::group(array('prefix' => 'admin', 'before' => 'auth'), function() {
	
	// Categories
	Route::get('/categories', 'AdminCategoriesController@index');
	Route::get('/categories/new', 'AdminCategoriesController@create');
	Route::get('/categories/delete/{id}', 'AdminCategoriesController@destroy');
	Route::get('/categories/edit/{id}', 'AdminCategoriesController@edit');
	Route::post('/categories/update', 'AdminCategoriesController@update');
	
	// News	
	Route::get('/news', 'AdminPostsController@index');
	Route::get('/news/create', 'AdminPostsController@create');
	Route::get('/news/delete/{id}', 'AdminPostsController@destroy');
	Route::get('/news/edit/{id}', 'AdminPostsController@edit');
	Route::post('/news/update', 'AdminPostsController@update');
	Route::post('/news/save', 'AdminPostsController@save');
	
	// Users
	Route::get('/users', 'AdminUsersController@index');
	Route::get('/users/create', 'AdminUsersController@create');
	Route::get('/users/delete/{id}', 'AdminUsersController@destroy');
	Route::get('/users/edit/{id}', 'AdminUsersController@edit');
	Route::post('/users/update', 'AdminUsersController@update');
	Route::post('/users/save', 'AdminUsersController@save');
	
	
    Route::get('/', 'AdminController@index');
	Route::get('logout', 'AdminController@logout');
	Route::post('/categories/save', array('uses' => 'AdminCategoriesController@save'));
	Route::post('/admin/news/save', array('uses' => 'AdminController@save_news'));
});