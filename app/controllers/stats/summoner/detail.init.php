<?php

class SummonerInit {
	public function init($data, $region, $region_name){
		$summary 		= $this->summary($data);
		$summary_ranked = $this->summary_ranked($data);

		return View::make('stats.summoner.detail', compact("data", "region", "region_name", "summary", "summary_ranked"));
	}

	private function summary($data){
		return View::make('stats.summoner.summary', compact("data"));
	}

	private function summary_ranked($data){
		return View::make('stats.summoner.summary_ranked', compact("data"));
	}
}