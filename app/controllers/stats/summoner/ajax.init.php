<?php

class MatchhistoryView {
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
				$need_api_request = true;
				$date1   = date('Y-m-d H:i:s');
				$date2   = $summoner["last_update_matchhistory"];
				$diff    = abs(strtotime($date2) - strtotime($date1));
				$mins    = floor($diff / 60);

				if($mins < $this->summoner_update_interval){
					$need_api_request = false;
				}

				if($need_api_request){
					$content = @file_get_contents($this->allowed_regions[$this->region]["api_endpoint"]."/api/lol/".$this->region."/v1.3/game/by-summoner/".trim($summoner["summoner_id"])."/recent?api_key=".$api_key);
					if($content !== FALSE){
						$json = json_decode($content, true);
						if(isset($json["games"][0]) && is_array($json["games"])){
							$games  = json_encode($json["games"]);
							$summoner->matchhistory = $games;
							$summoner->last_update_matchhistory = date('Y-m-d H:i:s');
							$summoner->save();
						}
					}
				}

				if(isset($summoner->matchhistory) && trim($summoner->matchhistory) != ""){
					$matchhistory_orig = json_decode($summoner->matchhistory, true);
					$region_name 	   = $this->allowed_regions[$this->region]["name"];
					$template          = "";
					foreach($matchhistory_orig as $game){
						$template .= $this->handleMatch($game, $summoner);
					}
					echo $template;
				} else {
					echo "Matchhistory konnte nicht geladen werden.";
				}
			} else {
				echo "Summoner not found";
			}
		} else {
			echo "Summoner not found";
		}
	}

	private function handleMatch($game, $summoner){
		$api_key = Config::get('api.key');

		$champion = Champion::where('champion_id', '=', trim($game["championId"]))->first();
		$game["items"] = array(0 => false, 1 => false, 2 => false, 3 => false, 4 => false, 5 => false, 6 => false);
		foreach($game["stats"] as $column => $value){
			if(strpos("platzhalter_".$column, "item") > 0){
				if($value > 0){
					$temp = Item::where('item_id', '=', $value)->first();
					$game["items"][intval(str_replace("item", "", $column))] = $temp;
				} else {
					$game["items"][intval(str_replace("item", "", $column))] = false;
				}
			}
		}

		$team1 = array();
		$team2 = array();
		if(isset($game["fellowPlayers"])){
			$summoner_ids = "";
			foreach($game["fellowPlayers"] as $player){
				$summoner_ids .= $player["summonerId"].",";
			}
			$summoner_data = @file_get_contents($this->allowed_regions[$this->region]["api_endpoint"]."/api/lol/euw/v1.4/summoner/".trim($summoner_ids)."?api_key=".$api_key);
			$summoner_data = json_decode($summoner_data, true);
			
			foreach($game["fellowPlayers"] as $player){
				if(isset($summoner_data[$player["summonerId"]])){
					$element = $summoner_data[$player["summonerId"]];
					$temp = array();
					$temp["name"]  	  = $element["name"];
					$temp["champion"] = Champion::where('champion_id', '=', trim($player["championId"]))->first();

					if($player["teamId"] == 100){
						$team1[] = $temp;
					} else {
						$team2[] = $temp;
					}
				}
			}
		}

		//echo "<pre>", print_r($game), "</pre>";
		return View::make('stats.summoner.matchhistory', [
					'game' 	   => $game,
					'champion' => $champion,
					'team1'	   => $team1,
					'team2'	   => $team2,
					'summoner' => $summoner
				])->render(); 
	}
}

?>