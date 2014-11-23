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
			$outputTime = $timediff / $hours;
			$html = "vor " . $outputTime . " minuten";
		} else if ($timediff >= $hours && $timediff < $days) {
			$outputTime = $timediff / $days;
			$html = "vor " . $outputTime . " Stunden";
		} else if ($timediff >= $days && $timediff < $oneWeek) {
			$outputTime = $timediff / $oneWeek;
			$html = "vor " . $outputTime . " Tagen";
		} else if ($timediff >= $days && $timediff < $oneWeek) {
			$outputTime = $timediff / $oneWeek;
			$html = "vor einer Woche";
		} else if ($timediff >= $oneWeek && $timediff < $normalDate) {
			$outputTime = $timediff / $twoWeek;
			$html = "vor 2 Wochen";
		} else {
			$html = date("d.m.Y", $created_timestamp);
		}
		
        return $html;
    }
}