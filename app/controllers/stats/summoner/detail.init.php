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

		return View::make('stats.summoner.detail', compact("data", "region", "region_name", "summary", "summary_ranked", "updates_this_time"));
	}

	private function summary($data){
		return View::make('stats.summoner.summary', compact("data"));
	}

	private function summary_ranked($data){
		return View::make('stats.summoner.summary_ranked', compact("data"));
	}
}