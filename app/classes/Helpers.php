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
		} 
        return $nice_role;
    }
}