<?php

class RankedStatsView {
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
				$content = @file_get_contents($this->allowed_regions[$this->region]["api_endpoint"]."/api/lol/".$this->region."/v1.3/stats/by-summoner/".trim($summoner["summoner_id"])."/ranked?season=".$this->current_season."&api_key=".$api_key);
				if($content !== FALSE){
					$json = json_decode($content, true);

					if(isset($json["champions"]) && is_array($json["champions"])){
						$out 	   = array();
						$sortArray = array(); 
					    foreach($json["champions"] as $key => $array) {
				        	$sortArray[$key] = $array["stats"]["totalSessionsPlayed"];
					    } 

					    array_multisort($sortArray, SORT_DESC, SORT_NUMERIC, $json["champions"]);
					    foreach($json["champions"] as $champion){
							if(isset($champion["stats"]["totalSessionsPlayed"]) && isset($champion["id"]) && $champion["id"] > 0){
								$champ = Champion::where("champion_id", "=", $champion["id"])->first();

								$temp = array();
								$temp["championId"] 		   = $champion["id"];
								$temp["championName"]		   = $champ["name"];
								$temp["championKey"]		   = $champ["key"];
								$temp["totalSessionsPlayed"]   = $champion["stats"]["totalSessionsPlayed"];
								$temp["totalSessionsLost"]     = $champion["stats"]["totalSessionsLost"];
								$temp["totalSessionsWon"]      = $champion["stats"]["totalSessionsWon"];
								$temp["totalChampionKills"]    = $champion["stats"]["totalChampionKills"];
								$temp["maxChampionsKilled"]    = $champion["stats"]["maxChampionsKilled"];
								$temp["totalMinionKills"]      = $champion["stats"]["totalMinionKills"];
								$temp["totalGoldEarned"]       = $champion["stats"]["totalGoldEarned"];
								$temp["totalTurretsKilled"]    = $champion["stats"]["totalTurretsKilled"];
								$temp["totalAssists"]		   = $champion["stats"]["totalAssists"];
								$temp["maxNumDeaths"]		   = $champion["stats"]["maxNumDeaths"];
								$temp["totalDeathsPerSession"] = $champion["stats"]["totalDeathsPerSession"];
								$out[] = $temp;
							}
						}

						return json_encode($out);
					} else {
						return "Es liegen noch keine genaueren Informationen über die Ranked-Stats von ".$summoner["name"]." vor.";
					}
				} else {
					return "Es liegen noch keine genaueren Informationen über die Ranked-Stats von ".$summoner["name"]." vor.";
				}
			}
		}
		return "Die Ranked-Stats konnten aufgrund eines unbekannten Fehlers nicht geladen werden.";
	}
}
?>