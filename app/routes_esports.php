<?php

	Route::get('/', 'EsportsController@index');
	Route::get('/{league_key}', 'EsportsController@leagueDetail');
	Route::get('/{league_key}/tournament/{tournament_id}/matches', 'EsportsController@tournamentMatches');
	Route::get('/{league_key}/tournament/{tournament_id}', 'EsportsController@tournamentDetail');
	Route::get('/{league_key}/tournament/{tournament_id}/match/{match_id}', 'EsportsController@tournamentMatchDetail');
    Route::get('/team/{team_acronym}', 'EsportsController@teamDetails');
