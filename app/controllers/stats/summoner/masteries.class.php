<?php

class MasteriesView {
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
			$output   = "Die Meisterschaften konnten nicht geladen werden";

			if(isset($summoner["id"]) && $summoner["id"] > 0){
				$need_api_request = true;
				$date1   = date('Y-m-d H:i:s');
				$date2   = $summoner["last_update_masteries"];
				$diff    = abs(strtotime($date2) - strtotime($date1));
				$mins    = floor($diff / 60);

				if($mins < $this->summoner_update_interval){
					$need_api_request = false;
				}

				if($need_api_request){
					$content = @file_get_contents($this->allowed_regions[$this->region]["api_endpoint"]."/api/lol/".$this->region."/v1.4/summoner/".trim($summoner["summoner_id"])."/masteries?api_key=".$api_key);
					if($content !== FALSE && trim($content) != ""){
						$json = json_decode($content, true);
						//echo "<pre>", print_r($json), "</pre>";
						if(isset($json[$summoner["summoner_id"]]["pages"]) && is_array($json[$summoner["summoner_id"]]["pages"])){
							$masteries = json_encode($json[$summoner["summoner_id"]]["pages"]);
							$summoner->masteries_data = $masteries;
							$summoner->last_update_masteries = date('Y-m-d H:i:s');
							$summoner->save();
							$updated = true;
						}
					}
					$summoner = Summoner::where('summoner_id', '=', trim($sID))->first();
				}

				$output = $summoner["masteries_data"];
			}
			return array("updated" => $updated, "template" => $output); 
		}
		return array("updated" => false, "template" => "Meisterschaften konnten nicht geladen werden.");
	}
}