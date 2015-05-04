<?php

class EsportsController extends BaseController {
	public function index(){
		$leagues = EsportsLeague::where("published_riot", "=", "1")->get();
		return View::make('esports.index', array(
			"leagues" => $leagues
		));
	}

	public function leagueDetail($league_key){
		$league_url  = $league_key;
		$league_key  = str_replace("_", " ", $league_key);
		$league 	 = EsportsLeague::where("short_name", "=", trim($league_key))->first();

		$tournaments = EsportsTournament::where("league_id", "=", $league["league_id"])->get();
		return View::make('esports.league_detail', array(
			"league" 	  => $league,
			"tournaments" => $tournaments,
			"league_url"  => $league_url
		));
	}

	public function tournamentDetail($league_key, $tournament_id){
		$league_url  = $league_key;
		$league_key  = str_replace("_", " ", $league_key);
		$league 	 = EsportsLeague::where("short_name", "=", trim($league_key))->first();

		$league_tournaments = EsportsTournament::where("league_id", "=", $league["league_id"])->get();
		$tournament = EsportsTournament::where("tournament_id", "=", $tournament_id)->first();

		$matches_upcoming = EsportsMatch::where("tournament_id", "=", $tournament_id)->where("date", ">", date("Y-m-d h:i:s"))->orderBy("date", "ASC")->get();
		$matches_past 	  = EsportsMatch::where("tournament_id", "=", $tournament_id)->where("date", "<=", date("Y-m-d h:i:s"))->orderBy("date", "DESC")->get();
		return View::make('esports.tournament_detail', array(
			"league" 	  		 => $league,
			"league_tournaments" => $league_tournaments,
			"tournament" 		 => $tournament,
			"league_url" 		 => $league_url,
			"matches_upcoming" 	 => $matches_upcoming,
			"matches_past"		 => $matches_past
		));
	}
}