<?php

class Summoner extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	
	public function games()
    {
        return $this->hasMany('Game', 'summoner_id', 'summoner_id');
    }
	
	public function refresh_games()
	{
				$api_key = Config::get('api.key');
				$summoner_data = "https://".$this->region.".api.pvp.net/api/lol/".$this->region."/v1.3/game/by-summoner/".$this->summoner_id."/recent?api_key=".$api_key;
				$json = @file_get_contents($summoner_data);
				if($json === FALSE) {
					return Redirect::to("/")->with("error", "There was an error with the Riot API, please try again later!");
				} else {
					$obj = json_decode($json, true);
					
					foreach($obj["games"] as $game) {
						
						$recent_game = Game::where('gameId', '=', $game["gameId"])->where('summoner_id', '=', $this->summoner_id)->first();
						if(!isset($recent_game)) {
							
							$newGame = new Game;
							
							$more_details = "https://".$this->region.".api.pvp.net/api/lol/".$this->region."/v2.2/match/".$game["gameId"]."?api_key=".$api_key;
							$json2 = @file_get_contents($more_details);
							if($json2 === FALSE) {
								
								$newGame->incomplete = true;
								$newGame->towerKills = 0;
								$newGame->firstTower = 0;
								$newGame->inhibitorKills = 0;
								$newGame->firstBaron = 0;
								$newGame->firstBlood = 0;
								$newGame->firstInhibitor = 0;
								$newGame->baronKills = 0;
								$newGame->dragonKills = 0;
								$newGame->firstDragon = 0;
								$newGame->doubleKills = 0;
								$newGame->tripleKills = 0;
								$newGame->quadraKills = 0;
								$newGame->pentaKills = 0;
								$newGame->firstBloodKill = 0;
								$newGame->exp_pm_zeroToTen = 0;
								$newGame->exp_pm_tenToTwenty = 0;
								$newGame->exp_pm_twentyToThirty = 0;
								$newGame->exp_pm_thirtyToEnd = 0;
								$newGame->gold_pm_zeroToTen = 0;
								$newGame->gold_pm_tenToTwenty = 0;
								$newGame->gold_pm_twentyToThirty = 0;
								$newGame->gold_pm_thirtyToEnd = 0;
								$newGame->cs_pm_zeroToTen = 0;
								$newGame->cs_pm_tenToTwenty = 0;
								$newGame->cs_pm_twentyToThirty = 0;
								$newGame->cs_pm_thirtyToEnd = 0;
								
							} else {
								$details = json_decode($json2, true);
							
								if(!isset($details["teams"])) {
									return Redirect::to("/")->with("error", "There was an error with the Riot API, please try again later!");
								}
								
								foreach($details["teams"] as $game_details) {
									if($game["teamId"] == $game_details["teamId"]) {
										$newGame->towerKills = $game_details["towerKills"];
										$newGame->firstTower = $game_details["firstTower"];
										$newGame->inhibitorKills = $game_details["inhibitorKills"];
										$newGame->firstBaron = $game_details["firstBaron"];
										$newGame->firstBlood = $game_details["firstBlood"];
										$newGame->firstInhibitor = $game_details["firstInhibitor"];
										$newGame->baronKills = $game_details["baronKills"];
										$newGame->dragonKills = $game_details["dragonKills"];
										$newGame->firstDragon = $game_details["firstDragon"];
									}
								}
								
								foreach($details["participants"] as $my_game_details) {
									if($my_game_details["championId"] == $game["championId"]) {
										
										$newGame->doubleKills = $my_game_details["stats"]["doubleKills"];
										$newGame->tripleKills = $my_game_details["stats"]["tripleKills"];
										$newGame->quadraKills = $my_game_details["stats"]["quadraKills"];
										$newGame->pentaKills = $my_game_details["stats"]["pentaKills"];
										
										
										if(isset($my_game_details["stats"]["firstBloodKill"])) {
											$newGame->firstBloodKill = $my_game_details["stats"]["firstBloodKill"];
										} else {
											$newGame->firstBloodKill = 0;
										}
										if(isset($my_game_details["stats"]["firstBloodAssist"])) {
											$newGame->firstBloodAssist = $my_game_details["stats"]["firstBloodAssist"];
										} else {
											$newGame->firstBloodAssist = 0;
										}
										
										
										$newGame->role = $my_game_details["timeline"]["role"];
										$newGame->lane = $my_game_details["timeline"]["lane"];
										
										
										if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["zeroToTen"])) {
											$newGame->exp_pm_zeroToTen = $my_game_details["timeline"]["xpPerMinDeltas"]["zeroToTen"];
										} else {
											$newGame->exp_pm_zeroToTen = 0;
										}
										
										if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["tenToTwenty"])) {
											$newGame->exp_pm_tenToTwenty = $my_game_details["timeline"]["xpPerMinDeltas"]["tenToTwenty"];
										} else {
											$newGame->exp_pm_tenToTwenty = 0;
										}
										
										if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["twentyToThirty"])) {
											$newGame->exp_pm_twentyToThirty = $my_game_details["timeline"]["xpPerMinDeltas"]["twentyToThirty"];
										} else {
											$newGame->exp_pm_twentyToThirty = 0;
										}
										
										if(isset($my_game_details["timeline"]["xpPerMinDeltas"]["thirtyToEnd"])) {
											$newGame->exp_pm_thirtyToEnd = $my_game_details["timeline"]["xpPerMinDeltas"]["thirtyToEnd"];
										} else {
											$newGame->exp_pm_thirtyToEnd = 0;
										}
										
										
										
										if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["zeroToTen"])) {
											$newGame->gold_pm_zeroToTen = $my_game_details["timeline"]["goldPerMinDeltas"]["zeroToTen"];
										} else {
											$newGame->gold_pm_zeroToTen = 0;
										}
										
										if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["tenToTwenty"])) {
											$newGame->gold_pm_tenToTwenty = $my_game_details["timeline"]["goldPerMinDeltas"]["tenToTwenty"];
										} else {
											$newGame->gold_pm_tenToTwenty = 0;
										}
										
										if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["twentyToThirty"])) {
											$newGame->gold_pm_twentyToThirty = $my_game_details["timeline"]["goldPerMinDeltas"]["twentyToThirty"];
										} else {
											$newGame->gold_pm_twentyToThirty = 0;
										}
										
										if(isset($my_game_details["timeline"]["goldPerMinDeltas"]["thirtyToEnd"])) {
											$newGame->gold_pm_thirtyToEnd = $my_game_details["timeline"]["goldPerMinDeltas"]["thirtyToEnd"];
										} else {
											$newGame->gold_pm_thirtyToEnd = 0;
										}
										
										
										
										if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["zeroToTen"])) {
											$newGame->cs_pm_zeroToTen = $my_game_details["timeline"]["creepsPerMinDeltas"]["zeroToTen"];
										} else {
											$newGame->cs_pm_zeroToTen = 0;
										}
										
										if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["tenToTwenty"])) {
											$newGame->cs_pm_tenToTwenty = $my_game_details["timeline"]["creepsPerMinDeltas"]["tenToTwenty"];
										} else {
											$newGame->cs_pm_tenToTwenty = 0;
										}
										
										if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["twentyToThirty"])) {
											$newGame->cs_pm_twentyToThirty = $my_game_details["timeline"]["creepsPerMinDeltas"]["twentyToThirty"];
										} else {
											$newGame->cs_pm_twentyToThirty = 0;
										}
										
										if(isset($my_game_details["timeline"]["creepsPerMinDeltas"]["thirtyToEnd"])) {
											$newGame->cs_pm_thirtyToEnd = $my_game_details["timeline"]["creepsPerMinDeltas"]["thirtyToEnd"];
										} else {
											$newGame->cs_pm_thirtyToEnd = 0;
										}
										
										
									}
								}
							
							
							}
							
							if(!isset($game["stats"]["item0"])) { $item0 = 0; }	else { $item0 = $game["stats"]["item0"]; }
							if(!isset($game["stats"]["item1"])) { $item1 = 0; }	else { $item1 = $game["stats"]["item1"]; }
							if(!isset($game["stats"]["item2"])) { $item2 = 0; }	else { $item2 = $game["stats"]["item2"]; }
							if(!isset($game["stats"]["item3"])) { $item3 = 0; }	else { $item3 = $game["stats"]["item3"]; }
							if(!isset($game["stats"]["item4"])) { $item4 = 0; }	else { $item4 = $game["stats"]["item4"]; }
							if(!isset($game["stats"]["item5"])) { $item5 = 0; }	else { $item5 = $game["stats"]["item5"]; }
							if(!isset($game["stats"]["item6"])) { $item6 = 0; }	else { $item6 = $game["stats"]["item6"]; }
							if(!isset($game["stats"]["totalHeal"])) { $totalHeal = 0; }	else { $totalHeal = $game["stats"]["totalHeal"]; }
							if(!isset($game["stats"]["killingSprees"])) { $killingSprees = 0; }	else { $killingSprees = $game["stats"]["killingSprees"]; }
							if(!isset($game["stats"]["wardKilled"])) { $wardKilled = 0; }	else { $wardKilled = $game["stats"]["wardKilled"]; }
							if(!isset($game["stats"]["turretsKilled"])) { $turretsKilled = 0; }	else { $turretsKilled = $game["stats"]["turretsKilled"]; }
							if(!isset($game["stats"]["minionsKilled"])) { $minionsKilled = 0; }	else { $minionsKilled = $game["stats"]["minionsKilled"]; }
							if(!isset($game["stats"]["neutralMinionsKilled"])) { $neutralMinionsKilled = 0; }	else { $neutralMinionsKilled = $game["stats"]["neutralMinionsKilled"]; }
							if(!isset($game["stats"]["neutralMinionsKilledEnemyJungle"])) { $neutralMinionsKilledEnemyJungle = 0; }	else { $neutralMinionsKilledEnemyJungle = $game["stats"]["neutralMinionsKilledEnemyJungle"]; }
							if(!isset($game["stats"]["wardPlaced"])) { $wardPlaced = 0; } else { $wardPlaced = $game["stats"]["wardPlaced"]; }
							if(!isset($game["stats"]["assists"])) { $assists = 0; }	else { $assists = $game["stats"]["assists"]; }
							if(!isset($game["stats"]["numDeaths"])) { $numDeaths = 0; }	else { $numDeaths = $game["stats"]["numDeaths"]; }
							if(!isset($game["stats"]["championsKilled"])) { $championsKilled = 0; }	else { $championsKilled = $game["stats"]["championsKilled"]; }
							if(!isset($game["stats"]["totalDamageTaken"])) { $totalDamageTaken = 0; } else { $totalDamageTaken = $game["stats"]["totalDamageTaken"]; }
							if(!isset($game["stats"]["totalDamageDealt"])) { $totalDamageDealt = 0; } else { $totalDamageDealt = $game["stats"]["totalDamageDealt"]; }
						
							
							$newGame->summoner_id = $this->summoner_id;
							$newGame->championId = $game["championId"];
							$newGame->gameId = $game["gameId"];
							$newGame->assists = $assists;
							$newGame->numDeaths = $numDeaths;
							$newGame->championsKilled = $championsKilled;
							$newGame->goldEarned = $game["stats"]["goldEarned"];
							$newGame->wardPlaced = $wardPlaced;
							$newGame->item0 = $item0;
							$newGame->item1 = $item1;
							$newGame->item2 = $item2;
							$newGame->item3 = $item3;
							$newGame->item4 = $item4;
							$newGame->item5 = $item5;
							$newGame->item6 = $item6;
							$newGame->spell1 = $game["spell1"];
							$newGame->spell2 = $game["spell2"];
							$newGame->gameMode = $game["gameMode"];
							$newGame->wardKilled = $wardKilled;
							$newGame->totalHeal = $totalHeal;
							$newGame->totalDamageTaken = $totalDamageTaken;
							$newGame->totalDamageDealt = $totalDamageDealt;
							$newGame->killingSprees = $killingSprees;
							$newGame->timePlayed = $game["stats"]["timePlayed"];
							$newGame->turretsKilled = $turretsKilled;
							$newGame->subType = $game["subType"];
							$newGame->gameType = $game["gameType"];
							$newGame->minionsKilled = $minionsKilled;
							$newGame->neutralMinionsKilled = $neutralMinionsKilled;
							$newGame->neutralMinionsKilledEnemyJungle = $neutralMinionsKilledEnemyJungle;
							$newGame->mapId = $game["mapId"];
							$newGame->teamId = $game["teamId"];
							$newGame->level = $game["stats"]["level"];
							$mil = $game["createDate"];
							$newGame->createDate = $mil;
							$newGame->win = $game["stats"]["win"];
							$newGame->save();
							
							$newGame->items()->attach($newGame->id, array("item_id"=>$item0));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item1));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item2));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item3));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item4));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item5));
							$newGame->items()->attach($newGame->id, array("item_id"=>$item6));
							
						}
						unset($recent_game);
					}
					
				}
			
			
	}
	
	
}