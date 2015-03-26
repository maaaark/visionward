<?php

class LeagueView {
	private $current_season = "SEASON2015";
	private $allowed_regions, $region, $summoner_update_interval;

	public function __construct($regions, $region, $summoner_update_interval){
		$this->allowed_regions 			= $regions;
		$this->region 		   		    = $region;
		$this->summoner_update_interval = $summoner_update_interval;
	}

	public function show($sID = false){
		if($sID){
			$updated  = false;
			$api_key  = Config::get('api.key');
			$summoner = Summoner::where('summoner_id', '=', trim($sID))->first();

			if(isset($summoner["id"]) && $summoner["id"] > 0){
				$need_api_request = true;
				$date1   = date('Y-m-d H:i:s');
				$date2   = $summoner["last_update_league"];
				$diff    = abs(strtotime($date2) - strtotime($date1));
				$mins    = floor($diff / 60);

				if($mins < $this->summoner_update_interval){
					$need_api_request = false;
				}

				if($need_api_request){
					$content = @file_get_contents($this->allowed_regions[$this->region]["api_endpoint"]."/api/lol/".$this->region."/v2.5/league/by-summoner/".trim($summoner["summoner_id"])."?api_key=".$api_key);
					$summoner->league_data = $content;
					$summoner->last_update_league = date("Y-m-d H:i:s");
					$summoner->save();
					$updated = true;
				} else {
					$content = $summoner["league_data"];
				}

				$template = "Die Liga konnte nicht geladen werden.";
				$json = json_decode($content, true);
				if(isset($json[$summoner->summoner_id]) && is_array($json[$summoner->summoner_id])){
					$array = array("info" => array(), "division" => array("I" => array(), "II" => array(), "III" => array(), "IV" => array(), "V" => array()));
					foreach($json[$summoner->summoner_id] as $league){
						if(isset($league["queue"]) && trim(strtoupper($league["queue"])) == "RANKED_SOLO_5X5" && isset($league["entries"]) && is_array($league["entries"])){
							$info = array("name" => $league["name"], "tier" => $league["tier"], "queue" => $league["queue"]);
							$array["info"] 		 = $info;
							$unknown_summoners   = array(0 => "");
							$unknown_summ_count  = 0;

							foreach($league["entries"] as $player){
								if(isset($player["division"])){
									if($player["playerOrTeamId"] == $summoner["summoner_id"]){
										$array["info"]["summoner_division"] = $player["division"];
										$player["highlight"] = "highlight";
									}

									$check = Summoner::where("summoner_id", "=", $player["playerOrTeamId"])->first();
									if(isset($check["id"]) && $check["id"] > 0){
										// Summoner-Bekannt
										$player["summonerIcon"] = $check["profileIconId"];
									} else {
										if($unknown_summ_count >= 35){
											$unknown_summoners[] = "";
											$unknown_summ_count  = 0;
										}

										$unknown_summoners[count($unknown_summoners) - 1] .= trim($player["playerOrTeamId"]).',';
										$unknown_summ_count++;
									}

									$array["division"][$player["division"]][] = $player;
								}
							}
							break;
						}
					}

					if(isset($array["info"]) && isset($array["division"]["I"][0]) && is_array($array["division"]["I"])){
						// Unbekannte Summoner-Icons laden
						if(isset($unknown_summoners[0]) && trim(str_replace(",", "", $unknown_summoners[0])) != ""){
							foreach($unknown_summoners as $unknown){
								$summoner_data_api = @file_get_contents($this->allowed_regions[$this->region]["api_endpoint"]."/api/lol/euw/v1.4/summoner/".trim($unknown)."?api_key=".$api_key);
								$summoner_data_api = json_decode($summoner_data_api, true);
								foreach($array["division"] as $division_key => $division){
									foreach($division as $key => $player){ 
										if(isset($summoner_data_api[$player["playerOrTeamId"]])){
											$summoner_player = $summoner_data_api[$player["playerOrTeamId"]];
											
											$array["division"][$division_key][$key]["summonerIcon"] = $summoner_player["profileIconId"];
											$new_summoner 					= new Summoner;
											$new_summoner->region 			= $this->region;
											$new_summoner->summoner_id 		= $summoner_player["id"];
											$new_summoner->name 			= $summoner_player["name"];
											$new_summoner->profileIconId 	= $summoner_player["profileIconId"];
											$new_summoner->summonerLevel 	= $summoner_player["summonerLevel"];
											$new_summoner->revisionDate 	= $summoner_player["revisionDate"];
											$new_summoner->save();
										}
									}
								}
							}
						}


						// Array sortieren -> Liga-Punkte absteigend
						foreach($array["division"] as $division_key => $division){
							$sortArray = array(); 
						    foreach($division as $key => $value){ 
						        $sortArray[$key] = $value["leaguePoints"]; 
						    }
							array_multisort($sortArray, SORT_DESC, SORT_NUMERIC, $division);
							$array["division"][$division_key] = $division;
						}

						$template = json_encode($array);
					} else {
						$template = "Die Liga konnte nicht geladen werden";
					}
				}

				return array("updated" => $updated, "template" => $template);
			} else {
				return array("updated" => $updated, "template" => "Die Liga konnte nicht geladen werden");
			}
		} else {
			return array("updated" => $updated, "template" => "Die Liga konnte aufgrund eines unbekannten Fehlers nicht geladen werden.");
		}
	}
}
?>