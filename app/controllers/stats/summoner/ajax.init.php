<?php

if(isset($_GET["matchhistory"])){
	require_once 'matchhistory.ajax.php';
	$matchhistory = new MatchhistoryView($this->allowed_regions, $region, $this->summoner_update_interval);
	$matchhistory->show();
}
elseif(isset($_GET["current_game"])){
	require_once 'current_game.ajax.php';
	$current_game = new CurrentGameView($this->allowed_regions, $region, $this->summoner_update_interval);
	$current_game->show();
}