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
Route::resource('players', 'PlayersController');
Route::resource('teams', 'TeamsController');
Route::resource('leagues', 'LeaguesController');
Route::resource('matches', 'MatchesController');
Route::resource('counterpicks', 'CounterpicksController');
Route::resource('searches', 'SearchesController');
Route::resource('feedbacks', 'FeedbacksController');
Route::resource('items', 'ItemsController');
Route::resource('users', 'UsersController');
Route::resource('vips', 'VipsController');
Route::resource('articles', 'ArticlesController');

Route::get('/', 'PostController@index');
Route::get('/login', 'AdminController@index');
Route::get('/logout', 'AdminController@logout');
Route::get('/team', 'HomeController@team');
Route::get('/datenschutz', 'HomeController@datenschutz');
Route::get('/impressum', 'HomeController@impressum');
Route::post('login', array('uses' => 'AdminController@doLogin'));
Route::post('/feedback', array('uses' => 'HomeController@feedback'));

// Summoner
Route::get('/summoner/{region}/{summoner_name}', 'SummonersController@show');
Route::get('/summoner/{region}/{summoner_name}/refresh', 'SummonersController@refresh_button');

// Skill
Route::get('/skills/{id}', 'ChampionsController@skill');

// Search
Route::post('/search', 'SearchesController@show_result');

// VIPs
Route::get('/vips/{id}/{slug}', 'VipsController@show');

// Articles
Route::get('/articles/{id}/{slug}', 'ArticlesController@show');

// News
Route::get('/news/{id}/{slug}', 'PostController@show');
Route::post('/counterpicks/create_counter', 'CounterpicksController@create_counter');

Route::get('/players/{id}/{slug}', 'PlayersController@show');
Route::get('/players_tooltip/{id}', 'PlayersController@tooltip');
Route::get('/casters_tooltip/{id}', 'VipsController@tooltip');
Route::get('/skill_tooltip/{id}', 'ChampionsController@skill_tooltip');
Route::get('/item_tooltip/{id}', 'ItemsController@item_tooltip');
Route::get('/counterpicks/create/{id}', 'CounterpicksController@create');


Route::get('/teams/{id}/{slug}', 'TeamsController@show');
Route::get('/leagues/{id}/{slug}', 'LeaguesController@show');
Route::get('/counterpicks/{id}/{slug}', 'CounterpicksController@show');
Route::get('/counterpicks/{id}/{slug}/{counter_champion_id}/{counter_champion_slug}', 'CounterpicksController@details');
Route::get('/championupvotes/{id}', 'CounterpicksController@championupvotes');
Route::get('/championdownvotes/{id}', 'CounterpicksController@championdownvotes');

// Transfer
Route::get('/transferlist', 'PlayersController@transferlist');

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function() {
	//Matches
	Route::resource('matches', 'AdminMatchesController');
    Route::resource('placements', 'AdminPlacementsController');
    Route::resource('leagues', 'AdminLeaguesController');
	Route::resource('vips', 'AdminVipsController');
	Route::resource('skins', 'AdminSkinsController');
	Route::resource('teams', 'AdminTeamsController');
	Route::resource('players', 'AdminPlayersController');
	Route::resource('champions', 'AdminChampionsController');
	Route::resource('counterpicks', 'AdminCounterpicksController');
	Route::resource('articles', 'AdminArticlesController');
	
	// Categories
	Route::get('/categories', 'AdminCategoriesController@index');
	Route::get('/categories/new', 'AdminCategoriesController@create');
	Route::get('/categories/delete/{id}', 'AdminCategoriesController@destroy');
	Route::get('/categories/edit/{id}', 'AdminCategoriesController@edit');
	Route::post('/categories/update', 'AdminCategoriesController@update');
	Route::post('/categories/save', 'AdminCategoriesController@save');
	
	// Pictures
	Route::get('/pictures', 'AdminPicturesController@index');
	Route::get('/pictures/create', 'AdminPicturesController@create');
	Route::get('/pictures/delete/{id}', 'AdminPicturesController@destroy');
	Route::get('/pictures/edit/{id}', 'AdminPicturesController@edit');
	Route::post('/pictures/update', 'AdminPicturesController@update');
	Route::post('/pictures/save', 'AdminPicturesController@save');
	
	// News	
	Route::get('/news', 'AdminPostsController@index');
	Route::get('/news/create', 'AdminPostsController@create');
	Route::get('/news/delete/{id}', 'AdminPostsController@destroy');
	Route::get('/news/edit/{id}', 'AdminPostsController@edit');
	Route::post('/news/update', 'AdminPostsController@update');
	Route::post('/news/save', 'AdminPostsController@save');
	
	// Galery	
	Route::get('/galleries', 'AdminGalleriesController@index');
	Route::get('/galleries/create', 'AdminGalleriesController@create');
	Route::get('/galleries/delete/{id}', 'AdminGalleriesController@destroy');
	Route::get('/galleries/edit/{id}', 'AdminGalleriesController@edit');
	Route::post('/galleries/update', 'AdminGalleriesController@update');
	Route::post('/galleries/save', 'AdminGalleriesController@save');
	
	// Users
	Route::get('/users', 'AdminUsersController@index');
	Route::get('/users/create', 'AdminUsersController@create');
	Route::get('/users/delete/{id}', 'AdminUsersController@destroy');
	Route::get('/users/edit/{id}', 'AdminUsersController@edit');
	Route::post('/users/update', 'AdminUsersController@update');
	Route::post('/users/save', 'AdminUsersController@save');
	
	// Settings
	Route::get('/settings', 'AdminSettingsController@index');
	Route::get('/settings/edit/{id}', 'AdminSettingsController@edit');
	Route::post('/settings/update', 'AdminSettingsController@update');
	
	// Sliders
	Route::get('/sliders', 'AdminSlidersController@index');
	Route::get('/sliders/create', 'AdminSlidersController@create');
	Route::get('/sliders/delete/{id}', 'AdminSlidersController@destroy');
	Route::get('/sliders/edit/{id}', 'AdminSlidersController@edit');
	Route::post('/sliders/update', 'AdminSlidersController@update');
	Route::post('/sliders/save', 'AdminSlidersController@save');
	
	
    Route::get('/', 'AdminController@index');
	Route::get('/logout', 'AdminController@logout');
	Route::post('/categories/save', array('uses' => 'AdminCategoriesController@save'));
	Route::post('/admin/news/save', array('uses' => 'AdminController@save_news'));
	
});