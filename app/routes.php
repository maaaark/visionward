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

// News
Route::get('/news/{id}', 'PostController@show');


Route::group(array('prefix' => 'admin', 'before' => 'auth'), function() {
	Route::get('/news', 'AdminController@news');
	Route::get('/categories', 'AdminCategoriesController@index');
	Route::get('/categories/new', 'AdminCategoriesController@create');
	Route::get('/categories/delete/{id}', 'AdminCategoriesController@destroy');
	Route::get('/news/{id}', 'AdminController@news_show');
    Route::get('/', 'AdminController@index');
	Route::get('logout', 'AdminController@logout');
	Route::post('login', array('uses' => 'AdminController@doLogin'));
	Route::post('/categories/save', array('uses' => 'AdminCategoriesController@save'));
	Route::post('/admin/news/save', array('uses' => 'AdminController@save_news'));
});