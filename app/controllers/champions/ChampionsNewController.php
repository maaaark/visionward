<?php

class ChampionsNewController extends \BaseController {

	private $matches_analysed;

	/**
	 * Display a listing of champions
	 *
	 * @return Response
	 */
	public function index()
	{
		$champions = Champion::orderBy("f2p", "DESC")->orderBy('name', 'ASC')->get();
		return View::make('champions_new.index', compact('champions'));
	}
	

	public function detail($champion_key, $region = "all"){
		define("GAME_VERSION", "5.9");

		$data  = Champion::where("key", "=", $champion_key)->first();
		$stats = $this->getStats($data, $region);
		return View::make('champions_new.detail', array(
			"data"     			   => $data,
			"stats"    		 	   => $stats,
			"playrate" 			   => $this->getPlayrates($data),
			"winrates" 			   => $this->getWinrates($data),
			"most_used_skillorder" => $this->getMostUsedSkillorder($data),
			"skills"			   => Skill::where("champion_id", "=", $data["champion_id"])->get()
		));	
	}
	
	private function getStats($champion, $region){
		$stats = array(
			"matches_count" 		=> 0,
			"wins"					=> 0,
			"kills"					=> 0,
			"deaths"				=> 0,
			"assists"				=> 0,
			"lasthits"				=> 0,
			"lasthits_jungle"		=> 0,
			"lasthits_jungle_enemy" => 0,
			"lasthits_jungle_team"	=> 0,
			"gold_spent"			=> 0,
			"gold_earned"			=> 0
		);
		if($region == "all"){
			$champ_stats = ChampionStats::where("champion", "=", $champion["champion_id"])->where("patch", "=", GAME_VERSION)->get();
			foreach($champ_stats as $champ){
				$stats["matches_count"] 		= $stats["matches_count"] + $champ["matches_count"];
				$stats["wins"] 					= $stats["wins"] + $champ["wins"];

				$stats["kills"]					= $this->durchschnitt($stats["kills"], $champ["kills"]);
				$stats["deaths"]				= $this->durchschnitt($stats["deaths"], $champ["deaths"]);
				$stats["assists"]				= $this->durchschnitt($stats["assists"], $champ["assists"]);
				$stats["lasthits"]				= $this->durchschnitt($stats["lasthits"], $champ["lasthits"]);
				$stats["lasthits_jungle"]		= $this->durchschnitt($stats["lasthits_jungle"], $champ["lasthits_jungle"]);
				$stats["lasthits_jungle_enemy"]	= $this->durchschnitt($stats["lasthits_jungle_enemy"], $champ["lasthits_jungle_enemy"]);
				$stats["lasthits_jungle_team"]	= $this->durchschnitt($stats["lasthits_jungle_team"], $champ["lasthits_jungle_team"]);
				$stats["gold_spent"]			= $this->durchschnitt($stats["gold_spent"], $champ["gold_spent"]);
				$stats["gold_earned"]			= $this->durchschnitt($stats["gold_earned"], $champ["gold_earned"]);
			}
		} else {
			$champ_stats = ChampionStats::where("champion", "=", $champion["champion_id"])->where("region", "=", trim(strtolower($region)))->where("patch", "=", GAME_VERSION)->first();
		}
		return $stats;
	}

	private function getPlayrates($champion){
		if($this->matches_analysed < 1){
			$this->getMatchesAnalysed();
		}

		$array   = array();
		$regions = array();
		$champ_stats = ChampionStats::where("champion", "=", $champion["champion_id"])->orderBy("patch", "DESC")->get();
		foreach($champ_stats as $champ){
			$regions[$champ["patch"]][$champ["region"]] = $champ["matches_count"];
		}

		$limit = 5;
		$count = 0;
		foreach($regions as $patch => $values){
			if($count >= $limit){
				break;
			}
			$count++;
			$temp = 0;
			foreach($values as $val){
				$temp = $temp + $val;
			}
			$temp = $temp / $this->matches_analysed * 100;
			$array[] = array("patch" => $patch, "value" => round($temp, 2));
		}
		return $array;
	}

	private function getWinrates($champion){
		if($this->matches_analysed < 1){
			$this->getMatchesAnalysed();
		}

		$array   = array();
		$regions = array();
		$champ_stats = ChampionStats::where("champion", "=", $champion["champion_id"])->orderBy("patch", "DESC")->get();
		foreach($champ_stats as $champ){
			$regions[$champ["patch"]][$champ["region"]] = array("matches" => $champ["matches_count"], "wins" => $champ["wins"]);
		}

		$limit = 5;
		$count = 0;
		foreach($regions as $patch => $values){
			if($count >= $limit){
				break;
			}
			$count++;
			$wins 	 = 0;
			$matches = 0;
			foreach($values as $val){
				$wins    = $wins + $val["wins"];
				$matches = $matches + $val["matches"];
			}
			$temp = $wins / $matches * 100;
			$array[] = array("patch" => $patch, "value" => round($temp, 1));
		}
		return $array;
	}

	private function getMostUsedSkillorder($champion){
		$skillorder = ChampionSkillorder::where("champion", "=", $champion["champion_id"])->where("patch", "=", GAME_VERSION)->orderBy("count", "DESC")->first();
		return $skillorder;
	}

	private function durchschnitt($value, $new){
		if($value == 0){
			return $new;
		}
		return ($value + $new) / 2;
	}

	private function getMatchesAnalysed($game_version = GAME_VERSION){
		$this->matches_analysed = 0;
		$champ_stats = ChampionStats::where("patch", "=", $game_version)->get();
		foreach($champ_stats as $champ){
			$this->matches_analysed = $this->matches_analysed + $champ["matches_count"];
		}
		$this->matches_analysed = round($this->matches_analysed / 10); // Hier durch 10 Teilen: da 10 Spieler pro Match
	}
}