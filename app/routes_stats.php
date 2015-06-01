<?php

	define("STATS_SECTION", "TRUE");

	Route::get('/', 'StatsController@index');
	Route::get('/{region}/{summoner_name}', 'StatsController@summoner');
	Route::get('/{region}/{summoner_name}/ajax', 'StatsController@ajax');
	Route::get('/summoner/{region}/{summoner_name}', 'StatsController@summoner');
	Route::get('/summoner/{region}/{summoner_name}/ajax', 'StatsController@ajax');