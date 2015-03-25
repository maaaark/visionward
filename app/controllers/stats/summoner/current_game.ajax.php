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
					echo "not_in_game";
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

						$team_data = $this->handlePlayer($json["participants"], $summoners_data, $summoner);
						$team1 = $team_data["team1"];
						$team2 = $team_data["team2"];

						$template = View::make('stats.summoner.current_game.detail', [
							'team1' => $team1,
							'team2' => $team2
						])->render();
						echo $template;
					} else {
						echo "not_in_game";
					}
				}
			} else {
				echo "not_in_game";
			}
		} else {
			echo "not_in_game";
		}
	}

	private function handlePlayer($data, $summoners_data, $summoner){
		$api_key = Config::get('api.key');
		$team1 	 = "";
		$team2 	 = "";

		foreach($data as $player){
			echo "<pre>", print_r($player), "</pre>";
			$champion = Champion::where("champion_id", "=", $player["championId"])->first();

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

			$highlight = false;
			if(trim(strtolower($player["summonerName"])) == trim(strtolower($summoner["name"]))){
				$highlight = true;
			}

			$template = View::make('stats.summoner.current_game.player', [
							'player'   	  => $player,
							'champion' 	  => $champion,
							'league_data' => $league_data,
							'normal_wins' => $normal_wins,
							'region'	  => $this->region,
							'highlight'	  => $highlight
						])->render();
			if($player["teamId"] == 100){
				$team1 .= $template;
			} else {
				$team2 .= $template;
			}
		}

		return array("team1" => $team1, "team2" => $team2);
	}
}