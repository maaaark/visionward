<?php
class Helpers {
    public static function diffForHumans($timestamp) {
		$created_timestamp = $timestamp->getTimestamp();
		$current_timestamp = time();
		
		$timediff = $current_timestamp - $created_timestamp;
		
		$minutes = 60;			// 60
		$hours = 3600;		// 60 * 60
		$days = 86400;		// $minutes * 60
		$oneWeek = 604800; 	// $days * 7
		$twoWeek = 1209600; 	// $oneWeek + $oneWeek
		$normalDate = 1814400;
		
		if($timediff < $minutes) {
			$html = "vor " . $timediff . " sekunden";
		} else if ($timediff >= $minutes && $timediff < $hours) {
			//var_dump($timediff,round($timediff / $minutes));
			$outputTime = round($timediff / $minutes);
			$html = "vor " . $outputTime . " minuten";
		} else if ($timediff >= $hours && $timediff < $days) {
			$outputTime = round($timediff / $hours);
			$html = "vor " . $outputTime . " Stunden";
		} else if ($timediff >= $days && $timediff < $twoWeek) {
			$outputTime = round($timediff / $days);
			$html = "vor " . $outputTime . " Tagen";
		} else {
			$html = date("d.m.Y", $created_timestamp);
		}
		
        return $html;
    }
	
	public static function niceLane($lane) {
		
		if($lane == "top") {
			$nice_lane = "Top-Lane";
		} elseif($lane == "jungle") {
			$nice_lane = "Jungle";
		} elseif($lane == "adc") {
			$nice_lane = "AD-Carry";
		} elseif($lane == "mid") {
			$nice_lane = "Mid-Lane";
		} elseif($lane == "support") {
			$nice_lane = "Supporter";
		} else {
			$nice_lane = "-";
		}
        return $nice_lane;
    }
	
	public static function niceRole($role) {
		
		if($role == "adcarry") {
			$nice_role = "Ad-Carry";
		} elseif($role == "coach") {
			$nice_role = "Coach";
		} elseif($role == "top") {
			$nice_role = "Top-Lane";
		} elseif($role == "mid") {
			$nice_role = "Mid-Lane";
		} elseif($role == "support") {
			$nice_role = "Supporter";
		} elseif($role == "jungle") {
			$nice_role = "Jungle";
		} elseif($role == "sub") {
			$nice_role = "Ersatzspieler";
		} else {
			$nice_role = "-";
		}
        return $nice_role;
    }
    
    public static function niceGameMode($gameMode) {
		if($gameMode == "CLASSIC") {
			$nice_gameMode = "Klassisch";
		} elseif($gameMode == "ODIN") {
			$nice_gameMode = "Dominion";
		} elseif($gameMode == "ARAM") {
			$nice_gameMode = "Aram";
		} else {
			$nice_gameMode = "Spezial Modus";
		}
        return $nice_gameMode;
    }
    
    public static function niceMatchMode($matchMode) {
		if($matchMode == "MATCHED_GAME") {
			$nice_matchMode = "Matched Game";
		} elseif($matchMode == "CUSTOM_GAME") {
			$nice_matchMode = "Freies Spiel";
		} else {
			$nice_matchMode = "Tutorial";
		}
        return $nice_matchMode;
    }
    
    public static function niceSubType($queueMode) {
		if($queueMode == "NONE") {
			$nice_queueMode = "Freies Spiel";
		} elseif($queueMode == "NORMAL") {
			$nice_queueMode = "Normales Spiel";
        } elseif($queueMode == "NORMAL_3x3") {
			$nice_queueMode = "Twisted Treeline";
        } elseif($queueMode == "ARAM_UNRANKED_5x5") {
			$nice_queueMode = "ARAM";
        } elseif($queueMode == "BOT ") {
			$nice_queueMode = "Bot Spiel";
        } elseif($queueMode == "RANKED_SOLO_5x5") {
			$nice_queueMode = "Solo Ranglisten Spiel";
        } elseif($queueMode == "RANKED_TEAM_3x3") {
			$nice_queueMode = "Team Ranglisten Spiel 3on3";
        } elseif($queueMode == "RANKED_TEAM_5x5") {
			$nice_queueMode = "Team Ranglisten Spiel 5on5";
        } elseif($queueMode == "URF") {
			$nice_queueMode = "Ultra Rapid Fire";
		} else {
			$nice_queueMode = "Anderer Spielmodus";
		}
        return $nice_queueMode;
    }

    public static function niceGameConfigID($gameConfigId){
    	if($gameConfigId == 0){
    		return "Freies Spiel";
    	} elseif($gameConfigId == 2){
    		return "Normal 5 gegen 5 Blind Pick";
    	} elseif($gameConfigId == 7 || $gameConfigId == 31 || $gameConfigId == 32 || $gameConfigId == 33 || $gameConfigId == 25 || $gameConfigId == 52){
    		return "Bot Game";
    	} elseif($gameConfigId == 8){
    		return "Normal 3 gegen 3";
    	} elseif($gameConfigId == 14){
    		return "Normal 5 gegen 5 Draft Pick";
    	} elseif($gameConfigId == 16 || $gameConfigId == 17){
    		return "Dominion";
    	} elseif($gameConfigId == 4){
    		return "Solo Ranglisten Spiel";
    	} elseif($gameConfigId == 9){
    		return "Ranked Premade Spiel 3on3";
    	} elseif($gameConfigId == 6){
    		return "Ranked Premade Spiel 5on5";
    	} elseif($gameConfigId == 41){
    		return "Team Ranglisten Spiel 3on3";
    	} elseif($gameConfigId == 42){
    		return "Team Ranglisten Spiel 5on5";
    	} elseif($gameConfigId == 61){
    		return "Team Builder Spiel";
    	} elseif($gameConfigId == 65){
    		return "ARAM Spiel";
    	}
    	return "Unbekannte Warteschlange";
    }
}