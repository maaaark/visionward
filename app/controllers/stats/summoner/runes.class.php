<?php

class RunesView {
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
			$output   = "Die Runen konnten nicht geladen werden";

			if(isset($summoner["id"]) && $summoner["id"] > 0){
				$need_api_request = true;
				$date1   = date('Y-m-d H:i:s');
				$date2   = $summoner["last_update_runes"];
				$diff    = abs(strtotime($date2) - strtotime($date1));
				$mins    = floor($diff / 60);

				if($mins < $this->summoner_update_interval){
					$need_api_request = false;
				}

				if($need_api_request){
					$content = @file_get_contents($this->allowed_regions[$this->region]["api_endpoint"]."/api/lol/".$this->region."/v1.4/summoner/".trim($summoner["summoner_id"])."/runes?api_key=".$api_key);
					if($content !== FALSE && trim($content) != ""){
						$json = json_decode($content, true);
						//echo "<pre>", print_r($json), "</pre>";
						if(isset($json[$summoner["summoner_id"]]["pages"]) && is_array($json[$summoner["summoner_id"]]["pages"])){
							$runes = json_encode($json[$summoner["summoner_id"]]["pages"]);
							$summoner->runes = $runes;
							$summoner->last_update_runes = date('Y-m-d H:i:s');
							$summoner->save();
							$updated = true;
						}
					}
					$summoner = Summoner::where('summoner_id', '=', trim($sID))->first();
				}

				$output = array();
				$json   = json_decode($summoner["runes"], true);
				foreach($json as $key => $rune_page){
					$temp = array("id" => $rune_page["id"], "current" => $rune_page["current"], "name" => $rune_page["name"], "slots" => array());
					if(isset($rune_page["slots"]) && is_array($rune_page["slots"])){
						foreach($rune_page["slots"] as $column => $value){
							$value["name"] = "Unbekannt";
							$value["description"] = "Nicht bekannt";

							$rune_object = Rune::where("rune_id", "=", $value["runeId"])->first();
							if(isset($rune_object["id"]) && $rune_object["id"] > 0){
								$value["name"] = $rune_object["name"];
								$value["description"] = $rune_object["description"];
							}

							$temp["slots"][$column] = $value;
						}
					}
					$output[$key] = $temp;
				}
				$output = json_encode($output);
			}
			return array("updated" => $updated, "template" => $output); 
		}
		return array("updated" => false, "template" => "Runen konnten nicht geladen werden.");
	}
}