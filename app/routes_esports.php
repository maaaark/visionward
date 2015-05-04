<?php

	Route::get('/', 'EsportsController@index');
	Route::get('/{league_key}', 'EsportsController@leagueDetail');
	Route::get('/{league_key}/tournament/{tournament_id}', 'EsportsController@tournamentDetail');