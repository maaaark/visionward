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

		$tournaments = EsportsTournament::where("league_id", "=", $league["league_id"])->orderBy("league_id", "DESC")->get();
		return View::make('esports.league_detail', array(
			"league" 	  => $league,
			"league_tournaments" => $tournaments,
			"league_url"  => $league_url
		));
	}

	public function tournamentDetail($league_key, $tournament_id){
		$league_url  = $league_key;
		$league_key  = str_replace("_", " ", $league_key);
		$league 	 = EsportsLeague::where("short_name", "=", trim($league_key))->first();

		$league_tournaments = EsportsTournament::where("league_id", "=", $league["league_id"])->orderBy("league_id", "DESC")->get();
		$tournament = EsportsTournament::where("tournament_id", "=", $tournament_id)->first();

		return View::make('esports.tournament.detail', array(
			"league" 	  		 => $league,
			"league_tournaments" => $league_tournaments,
			"tournament" 		 => $tournament,
			"league_url" 		 => $league_url
		));
	}

	public function tournamentMatches($league_key, $tournament_id){
		$league_url  = $league_key;
		$league_key  = str_replace("_", " ", $league_key);
		$league 	 = EsportsLeague::where("short_name", "=", trim($league_key))->first();

		$league_tournaments = EsportsTournament::where("league_id", "=", $league["league_id"])->orderBy("league_id", "DESC")->get();
		$tournament = EsportsTournament::where("tournament_id", "=", $tournament_id)->first();

		$matches_upcoming = EsportsMatch::where("tournament_id", "=", $tournament_id)->where("date", ">", date("Y-m-d h:i:s"))->orderBy("date", "ASC")->get();
		$matches_past 	  = EsportsMatch::where("tournament_id", "=", $tournament_id)->where("date", "<=", date("Y-m-d h:i:s"))->orderBy("date", "DESC")->get();
		return View::make('esports.tournament.matches', array(
			"league" 	  		 => $league,
			"league_tournaments" => $league_tournaments,
			"tournament" 		 => $tournament,
			"league_url" 		 => $league_url,
			"matches_upcoming" 	 => $matches_upcoming,
			"matches_past"		 => $matches_past
		));
	}

	public function tournamentMatchDetail($league_key, $tournament_id, $match_id){
		$league_url  = $league_key;
		$league_key  = str_replace("_", " ", $league_key);
		$league 	 = EsportsLeague::where("short_name", "=", trim($league_key))->first();

		$league_tournaments = EsportsTournament::where("league_id", "=", $league["league_id"])->orderBy("league_id", "DESC")->get();
		$tournament = EsportsTournament::where("tournament_id", "=", $tournament_id)->first();

		$match = EsportsMatch::where("match_id", "=", $match_id)->first();

		$team1 = EsportsTeam::where("team_id", "=", $match->team1_id)->first();
		$team2 = EsportsTeam::where("team_id", "=", $match->team2_id)->first();

		$games 	   = "";
		$games_arr = json_decode($match->games, true);
		$count     = 1;


		foreach($games_arr as $game){
			$esports_game = EsportsGame::where("game_id", "=", $game)->first();
			$games       .= View::make('esports.tournament.game_detail', array(
								"league" 	  		 => $league,
								"league_tournaments" => $league_tournaments,
								"tournament" 		 => $tournament,
								"league_url" 		 => $league_url,
								"match"				 => $match,
								"game"				 => $esports_game,
								"game_count"		 => $count,
								"player"			 => json_decode($esports_game->players, true),
								"team1"				 => $team1,
								"team2"				 => $team2
							));
			$count++;
		}

		return View::make('esports.tournament.match_detail', array(
			"league" 	  		 => $league,
			"league_tournaments" => $league_tournaments,
			"tournament" 		 => $tournament,
			"league_url" 		 => $league_url,
			"match"				 => $match,
			"games"				 => $games,
			"team1"				 => $team1,
			"team2"				 => $team2
		));
	}
}