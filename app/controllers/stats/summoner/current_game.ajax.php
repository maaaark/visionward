<?php

class CurrentGameView {
	private $current_season = "SEASON2015";
	private $allowed_regions, $region, $summoner_update_interval;

	public function __construct($regions, $region, $summoner_update_interval){
		$this->allowed_regions 			= $regions;
		$this->region 		   		    = $region;
		$this->summoner_update_interval = $summoner_update_interval;
	}

	public function show(){
		if(isset($_GET["sID"])){
			$api_key = Config::get('api.key');
			$summoner = Summoner::where('summoner_id', '=', trim($_GET["sID"]))->first();

			if(isset($summoner["id"]) && $summoner["id"] > 0){
				$content = @file_get_contents($this->allowed_regions[$this->region]["api_endpoint"]."/observer-mode/rest/consumer/getSpectatorGameInfo/".$this->allowed_regions[$this->region]["platform_id"]."/".$summoner["summoner_id"]."?api_key=".$api_key);

				if($content === FALSE){
					return "not_in_game";
				} else {
					$json = json_decode($content, true);
					
					if(isset($json["gameId"]) && isset($json["participants"]) && is_array($json["participants"])){
						$summoner_ids = "";
						foreach($json["participants"] as $player){
							$summoner_ids .= trim($player["summonerId"]).",";
						}
						
						// Ligen laden
						$summoners_data = array();
						$summoners 		 = @file_get_contents($this->allowed_regions[$this->region]["api_endpoint"]."/api/lol/".$this->region."/v2.5/league/by-summoner/".trim($summoner_ids)."/entry?api_key=".$api_key);
						if($summoners !== FALSE && trim($summoners) != ""){
							$summoners_json = json_decode($summoners, true);
							
							foreach($summoners_json as $summoner_id => $player){
								foreach($player as $queue){
									if(isset($queue["queue"]) && trim(strtoupper($queue["queue"])) == "RANKED_SOLO_5X5"){
										$summoners_data[$summoner_id] = $queue;
									}
								}
							}
						}
						
						// Team Elos ermitteln
						$team1_count = 0;
						$team1_elo   = 0;
						$team2_count = 0;
						$team2_elo   = 0;
						foreach($json["participants"] as $player){
              //echo "<pre>", print_r($player), "</pre>";
              if(isset($summoners_data[$player["summonerId"]]) && is_array($summoners_data[$player["summonerId"]]) && isset($summoners_data[$player["summonerId"]]["entries"])){
                 $temp_arr = $summoners_data[$player["summonerId"]];
                 $elo_temp = Helpers::summonerElo($temp_arr["tier"], $temp_arr["entries"][0]["division"], $temp_arr["entries"][0]["leaguePoints"]);
                 if($player["teamId"] == 100){
                    $team1_count++;
                    $team1_elo = $team1_elo + $elo_temp;
                 } else {
                    $team2_count++;
                    $team2_elo = $team2_elo + $elo_temp;
                 }
              }
						}
						$team1_elo = round($team1_elo / $team1_count);
						$team2_elo = round($team2_elo / $team2_count);

						$team_data = $this->handlePlayer($json["participants"], $summoners_data, $summoner);
						$team1 = $team_data["team1"];
						$team2 = $team_data["team2"];

						// Gebannte Champs
						$bans_team1 = false;
						$bans_team2 = false;
						if(isset($json["bannedChampions"]) && is_array($json["bannedChampions"])){
							$bans_team1 = array();
							$bans_team2 = array();
							foreach($json["bannedChampions"] as $banned_champ){
								if(isset($banned_champ["championId"]) && isset($banned_champ["teamId"])){
									$champ_temp = Champion::where("champion_id", "=", $banned_champ["championId"])->first();

									if(isset($champ_temp["id"]) && $champ_temp["id"] > 0){
										$temp = array();
										$temp["champion_id"] = $banned_champ["championId"];
										$temp["pick_turn"]   = $banned_champ["pickTurn"];
										$temp["champion"]	 = $champ_temp;
										if($banned_champ["teamId"] == 100){
											$bans_team1[] = $temp;
										} else {
											$bans_team2[] = $temp;
										}
									}
								}
							}
						}

						$template = View::make('stats.summoner.current_game.detail', [
							'game'  => $json,
							'team1' => $team1,
							'team2' => $team2,
							'bans_team1' => $bans_team1,
							'bans_team2' => $bans_team2,
							'team1_elo'  => $team1_elo,
							'team2_elo'  => $team2_elo
						])->render();
						return $template;
					} else {
						return "not_in_game";
					}
				}
			} else {
				return "not_in_game";
			}
		} else {
			return "not_in_game";
		}
	}

	private function handlePlayer($data, $summoners_data, $summoner){
		$api_key = Config::get('api.key');
		$team1 	 = "";
		$team2 	 = "";

		foreach($data as $player){
			//echo "<pre>", print_r($player), "</pre>";
			$champion = Champion::where("champion_id", "=", $player["championId"])->first();

			// Liga-Infos laden
			$league_data = array("name" => false, "tier" => false, "tier_transform" => false, "queue" => false);
			if(isset($summoners_data[$player["summonerId"]])){
				$league_data_backup = $summoners_data[$player["summonerId"]];
				
				$league_data["name"]		   = $league_data_backup["name"];
				$league_data["tier"] 		   = $league_data_backup["tier"];
				$league_data["tier_transform"] = ucfirst(strtolower($league_data_backup["tier"]));
				$league_data["queue"] 		   = $league_data_backup["queue"];

				if(isset($league_data_backup["entries"][0]) && is_array($league_data_backup["entries"][0])){ 
					foreach($league_data_backup["entries"][0] as $column => $value){
						$league_data[$column] = $value;
					}
				}
			}

			// Normal-Wins laden
			$normal_wins = false;
			$wins_data   = @file_get_contents($this->allowed_regions[$this->region]["api_endpoint"]."/api/lol/euw/v1.3/stats/by-summoner/".$player["summonerId"]."/summary?season=".$this->current_season."&api_key=".$api_key);
			if($wins_data !== FALSE && trim($wins_data) != ""){
				$wins = json_decode($wins_data, true);
				if(isset($wins["playerStatSummaries"]) && is_array($wins["playerStatSummaries"])){
					foreach($wins["playerStatSummaries"] as $win_data){
						if(isset($win_data["playerStatSummaryType"]) && trim($win_data["playerStatSummaryType"]) == "Unranked" && isset($win_data["wins"])){
							$normal_wins = $win_data["wins"];
						}
					}
				}
			}

			// Runen laden
			if(isset($player["runes"]) && is_array($player["runes"])){
				for($i = 0; $i<count($player["runes"]); $i++){
					$rune = Rune::where("rune_id", "=", $player["runes"][$i]["runeId"])->first();
					$player["runes"][$i]["name"] 		= $rune["name"];
					$player["runes"][$i]["description"] = $rune["description"];
				}
			}

			// Summoner-Highlighten
			$highlight = false;
			if(trim(strtolower($player["summonerName"])) == trim(strtolower($summoner["name"]))){
				$highlight = true;
			}

			// Meisterschaften laden
			$masteries = array("offense" => 0, "defense" => 0, "utility" => 0);
			if(isset($player["masteries"]) && is_array($player["masteries"])){
				foreach($player["masteries"] as $mastery){
					if(isset($mastery["masteryId"])){
						$mastery_object = Mastery::where("mastery_id", "=", $mastery["masteryId"])->first();
						if(isset($mastery_object["mastery_tree"]) && trim($mastery_object["mastery_tree"]) != ""){
							$type = trim(strtolower($mastery_object["mastery_tree"]));

							if($type == "utility"){
								$masteries["utility"] = $masteries["utility"] + $mastery["rank"];
							}
							elseif($type == "offense"){
								$masteries["offense"] = $masteries["offense"] + $mastery["rank"];
							}
							elseif($type == "defense"){
								$masteries["defense"] = $masteries["defense"] + $mastery["rank"];
							}
						}
					}
				}
			}

			//echo "<pre>", print_r($player), "</pre>";
			// Template-Anzeigen
			$template = View::make('stats.summoner.current_game.player', [
							'player'   	  => $player,
							'champion' 	  => $champion,
							'league_data' => $league_data,
							'normal_wins' => $normal_wins,
							'region'	  => $this->region,
							'highlight'	  => $highlight,
							'masteries'   => $masteries
						])->render();

			// Template-richtigem Team zuordnen
			if($player["teamId"] == 100){
				$team1 .= $template;
			} else {
				$team2 .= $template;
			}
		}

		return array("team1" => $team1, "team2" => $team2);
	}
}