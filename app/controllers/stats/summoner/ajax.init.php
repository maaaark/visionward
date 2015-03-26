<?php

if(isset($_GET["data"]) && isset($_GET["sID"])){
	$array = array();

	require_once 'matchhistory.ajax.php';
	$matchhistory = new MatchhistoryView($this->allowed_regions, $region, $this->summoner_update_interval);
	$array["matchhistory"] = $matchhistory->show();

	require_once 'ranked_stats.ajax.php';
	$ranked_stats = new RankedStatsView($this->allowed_regions, $region, $this->summoner_update_interval);
	$array["ranked_stats"] = $ranked_stats->show();

	echo json_encode($array);
}
elseif(isset($_GET["current_game"])){
	require_once 'current_game.ajax.php';
	$current_game = new CurrentGameView($this->allowed_regions, $region, $this->summoner_update_interval);
	echo $current_game->show();
}