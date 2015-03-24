<?php

	Route::get('/', 'StatsController@index');
	Route::get('/summoner/{region}/{summoner_name}', 'StatsController@summoner');
	Route::get('/summoner/{region}/{summoner_name}/ajax', 'StatsController@ajax');