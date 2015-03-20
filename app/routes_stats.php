<?php

	Route::get('/', 'StatsController@index');
	Route::get('/summoner/{region}/{summoner_name}', 'StatsController@summoner');