<?php

class SummonerInit {
	public function init($data, $region, $region_name, $summoner_update_interval){
		$summary 		= $this->summary($data);
		$summary_ranked = $this->summary_ranked($data);

		$updates_this_time = true;
		$date1  		   = date('Y-m-d H:i:s');
		$date2   		   = $data["last_update_detail_data"];
		$diff    		   = abs(strtotime($date2) - strtotime($date1));
		$mins    		   = floor($diff / 60);

		if($mins < $summoner_update_interval){
			$updates_this_time = false;
		}
		
		$solo_q_data = false;
		if(isset($data["ranked_summary"])){
			$solo_q_data_temp = json_decode($data["ranked_summary"], true);
			if(isset($solo_q_data_temp["RANKED_SOLO_5x5"]) && isset($solo_q_data_temp["RANKED_SOLO_5x5"]["tier"]) && trim($solo_q_data_temp["RANKED_SOLO_5x5"]["tier"]) != ""){
				$solo_q_data = $solo_q_data_temp["RANKED_SOLO_5x5"];
			}
		}

		// Search-Count vom Summoner hochzählen
		$data->searched = $data->searched + 1;
		$data->save();
		
		return View::make('stats.summoner.detail', compact("data", "region", "region_name", "summary", "summary_ranked", "updates_this_time", "solo_q_data"));
	}

	private function summary($data){
		return View::make('stats.summoner.summary', compact("data"));
	}

	private function summary_ranked($data){
		return View::make('stats.summoner.summary_ranked', compact("data"));
	}
}