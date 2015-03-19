<?php

class StatsController extends BaseController {
	private $allowed_regions = array(
									"euw" => array("status" => true, "api_endpoint" => "https://euw.api.pvp.net", "name" => "Europe West", "platform_id" => "EUW1"), // PlatformId -> für Spectator Mode
									"na"  => array("status" => true, "api_endpoint" => "https://euw.api.pvp.net", "name" => "Nordamerika", "platform_id" => "NA1")
									);
	private $summoner_update_interval = 60;

	public function index()
	{
		return View::make('stats.index');
	}

	public function summoner($region, $summoner_name){
		$region = trim(strtolower($region));
		if(isset($this->allowed_regions[$region]) && isset($this->allowed_regions[$region]["status"]) && $this->allowed_regions[$region]["status"] == true){
			$data = Summoner::where('name', 'LIKE', trim($summoner_name))->first();
			
			$need_api_request = true;
			if(isset($data["id"]) && $data["id"] > 0){
				$date1   = date('Y-m-d H:i:s');
				$date2   = $data["last_update_maindata"];
				$diff    = abs(strtotime($date2) - strtotime($date1));
				$mins    = floor($diff / 60);

				if($mins < $this->summoner_update_interval){
					$need_api_request = false;
				}
			}

			if($need_api_request){
				$clean_summoner_name = str_replace(" ", "", $summoner_name);
				$clean_summoner_name = strtolower($clean_summoner_name);
				$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');

				$api_key 		   = Config::get('api.key');
				$summoner_name_url = trim(str_replace(" ", "%20", $region));
				$summoner_data     = $this->allowed_regions[$region]["api_endpoint"]."/api/lol/".$region."/v1.4/summoner/by-name/".$clean_summoner_name."?api_key=".$api_key;
				$json = @file_get_contents($summoner_data);
				if($json === FALSE) {
					return Redirect::to("/")->with("error", "There was an error with the Riot API, please try again later! Code: 005");
				} else {
					$obj = json_decode($json, true);
					$summoner = Summoner::where("name","=",$obj[$clean_summoner_name]["name"])->where("region","=",$region)->first();
					if(!$summoner) {
						$summoner = new Summoner;
					}
					$summoner->summoner_id = $obj[$clean_summoner_name]["id"];
					$summoner->name = $obj[$clean_summoner_name]["name"];
					$summoner->profileIconId = $obj[$clean_summoner_name]["profileIconId"];
					$summoner->summonerLevel = $obj[$clean_summoner_name]["summonerLevel"];
					$summoner->revisionDate = $obj[$clean_summoner_name]["revisionDate"];
					$summoner->region = $region;
					$summoner->last_update_maindata = date('Y-m-d H:i:s');
					$summoner_stats = "https://".$region.".api.pvp.net/api/lol/".$region."/v1.3/stats/by-summoner/".$summoner->summoner_id."/summary?season=SEASON2015&api_key=".$api_key;
					$json2 = @file_get_contents($summoner_stats);
					if($json2 === FALSE) {
						return View::make('searches.show_result', compact('searchString', 'news', 'champs', 'players', 'teams', 'summoner'));
					} else {
						$obj2 = json_decode($json2, true);
						if(isset($obj2["playerStatSummaries"])){
							foreach($obj2["playerStatSummaries"] as $gamemode){
								if($gamemode["playerStatSummaryType"] == 'RankedSolo5x5'){
									$summoner->ranked_wins = $gamemode['wins'];
									$summoner->ranked_losses = $gamemode['losses'];
								}
								if($gamemode["playerStatSummaryType"] == 'Unranked'){
									$summoner->unranked_wins = $gamemode['wins'];
								}
								if($gamemode["playerStatSummaryType"] == 'RankedTeam5x5'){
									$summoner->teamranked_wins = $gamemode['wins'];
									$summoner->teamranked_losses = $gamemode['losses'];
								}
							}
						}
						$summoner->save();
					}
					$data = Summoner::where('name', 'LIKE', trim($summoner_name))->first();
				}
			}

			/* SUMMONER_DATEN anzeigen */
			if(isset($data["id"]) && $data["id"] > 0){
				include 'summoner/detail.init.php';
				$init = new SummonerInit;
				return $init->init($data, $region, $this->allowed_regions[$region]["name"]);
			} else {
				echo "Summoner nicht gefunden";
			}
		} else {
			echo "gesperrte region";
		}
	}
	
	

}