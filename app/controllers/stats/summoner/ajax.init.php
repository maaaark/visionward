<?php
function checkIfAllDataIsUpdated($updated){
	$status = true;
	foreach($updated as $element){
		if($element != true){
			$status = false;
		}
	}
	return $status;
}


if(isset($_GET["data"]) && isset($_GET["sID"]) && $_GET["sID"] > 0){
	$sID     = $_GET["sID"];
	$array   = array();
	$updated = array("matchhistory" => false, "ranked_stats" => false, "league" => false, "runes" => false, "masteries");

	// Matchhistory
	require_once 'matchhistory.class.php';
	$matchhistory 		   = new MatchhistoryView($this->allowed_regions, $region, $this->summoner_update_interval);
	$matchhistory_data 	   = $matchhistory->show($sID);
	$array["matchhistory"] = $matchhistory_data["template"];
	if(isset($matchhistory_data["updated"]) && $matchhistory_data["updated"] == true){
		$updated["matchhistory"] = true;
	}

	// Ranked-Stats
	require_once 'ranked_stats.class.php';
	$ranked_stats 	       = new RankedStatsView($this->allowed_regions, $region, $this->summoner_update_interval);
	$ranked_stats_data     = $ranked_stats->show($sID);
	$array["ranked_stats"] = $ranked_stats_data["template"];
	if(isset($ranked_stats_data["updated"]) && $ranked_stats_data["updated"] == true){
		$updated["ranked_stats"] = true;
	}

	// Liga
	require_once 'league.class.php';
	/*$league      	       = new LeagueView($this->allowed_regions, $region, $this->summoner_update_interval);
	$league_data 	       = $league->show($sID);
	$array["league"] 	   = $league_data["template"];
	if(isset($league_data["updated"]) && $league_data["updated"] == true){
		$updated["league"] = true;
	}*/
	$array["league"] = "Ligen wurden aufgrund von Wartungsarbeiten temporär deaktiviert.";


	// Runen
	require_once 'runes.class.php';
	$runes      	       = new RunesView($this->allowed_regions, $region, $this->summoner_update_interval);
	$runes_data 	       = $runes->show($sID);
	$array["runes"] 	   = $runes_data["template"];
	if(isset($runes_data["updated"]) && $runes_data["updated"] == true){
		$updated["runes"] = true;
	}

	// Meisterschaften
	require_once 'masteries.class.php';
	$masteries     	       = new MasteriesView($this->allowed_regions, $region, $this->summoner_update_interval);
	$masteries_data	       = $masteries->show($sID);
	$array["masteries"]    = $masteries_data["template"];
	if(isset($masteries_data["updated"]) && $masteries_data["updated"] == true){
		$updated["masteries"] = true;
	}


	// Daten ausgeben
	echo json_encode($array);

	// Update-Status aktualisieren
	if(checkIfAllDataIsUpdated($updated)){
		$summoner = Summoner::where('summoner_id', '=', trim($sID))->first();
		if(isset($summoner["id"]) && $summoner["id"] > 0){
			$summoner->last_update_detail_data = date('Y-m-d H:i:s');
			$summoner->updated_count           = $summoner->updated_count + 1;
			$summoner->save();
		}
	}
}
elseif(isset($_GET["current_game"])){
	require_once 'current_game.ajax.php';
	$current_game = new CurrentGameView($this->allowed_regions, $region, $this->summoner_update_interval);
	echo $current_game->show();
}