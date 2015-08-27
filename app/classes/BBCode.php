<?php

class BBCode {

	public static function render($string){
		$string = BBCode::league_of_legends($string);
		return $string;
	}

	public static function league_of_legends($string){
		$pattern = '#\[(.*)\](.*)\[/(.*)\]#isU';
   		preg_match_all($pattern, $string, $array);
   		echo "<pre>", print_r($array), "</pre>";

   		if($array && is_array($array) && isset($array[0]) && isset($array[3])){
   			for($i = 0; $i < count($array[0]); $i++){
   				if(isset($array[3][$i])){
					$type = strtoupper(trim($array[3][$i]));
					if($type == "SKILL"){
						$string = BBCode::handle_lol_skill($string, $array, $i);
					}
   				}
   			}
   		}

   		//die();
   		return $string;
	}

	public static function handle_lol_skill($string, $array, $i){
		$patchversion = Helpers::patchversion();
		$replace = "Unbekannte F&auml;higkeit";
		$champion = Champion::where("name", "LIKE", trim($array[2][$i]))->orWhere("key", "=", trim($array[2][$i]))->first();
		if(isset($champion->id) && $champion->id > 0){
			if(strpos($array[1][$i], "=") > 0){
				$spell_type = trim(substr($array[1][$i], strpos($array[1][$i], "=") + 1));
				if(strtolower($spell_type) == "p" || strtolower($spell_type) == "passive" || strtolower($spell_type) == "passiv"){
					$spell_type = "passive";
				}

				if($spell_type == "passive"){
					$skill = Skill::where("champion_id", "=", $champion->champion_id)->where("passive", "=", "1")->first();
				} else {
					$skill = Skill::where("champion_id", "=", $champion->champion_id)->where("hotkey", "LIKE", trim(strtoupper($spell_type)))->first();
				}
				if(isset($skill->id) && $skill->id > 0){
					$replace  = '<a class="skill_tooltip bbcode" href="/skills/'.$skill->id.'" rel="'.$skill->id.'" title="">';
					if($spell_type == "passive"){
						$replace .= '<img src="http://ddragon.leagueoflegends.com/cdn/'.$patchversion.'/img/passive/'.$skill->icon.'" class="img-circle" style="height: 18px;"> ';
					} else {
						$replace .= '<img src="http://ddragon.leagueoflegends.com/cdn/'.$patchversion.'/img/spell/'.$skill->icon.'" class="img-circle" style="height: 18px;"> ';
					}
					$replace .= '('.strtoupper($skill->hotkey).') '.trim($skill->name);
					$replace .= '</a>';
				}
			}
		}
		return str_replace($array[0][$i], $replace, $string);
	}
}