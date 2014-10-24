<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshChampions extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:champions';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refreshing Champion data from API';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$api_key = Config::get('api.key');
		$summoner_data = "https://global.api.pvp.net/api/lol/static-data/euw/v1.2/champion?locale=de_DE&champData=all&api_key=".$api_key;
		$json = @file_get_contents($summoner_data);
		if($json === FALSE) {
			return View::make('login');
		} else {
			$obj = json_decode($json, true);
			$version = Setting::where('key', '=', 'patch_number')->first();
			if($version){ $version->value = $obj['version']; $version->save();}
			foreach($obj["data"] as $champion) {
				$recent_champion = Champion::where('champion_id', '=', $champion["id"])->first();
				if(!isset($recent_champion)) {
					$new_champion = new Champion;
					$new_champion->name = $champion["name"];
					$new_champion->title = $champion["title"];
					$new_champion->champion_id = $champion["id"];
					$new_champion->key = $champion["key"];
					$new_champion->attackrange = $champion["stats"]["attackrange"];
					$new_champion->mpperlevel = $champion["stats"]["mpperlevel"];
					$new_champion->mp = $champion["stats"]["mp"];
					$new_champion->attackdamage = $champion["stats"]["attackdamage"];
					$new_champion->hp = $champion["stats"]["hp"];
					$new_champion->hpperlevel = $champion["stats"]["hpperlevel"];
					$new_champion->attackdamageperlevel = $champion["stats"]["attackdamageperlevel"];
					$new_champion->armor = $champion["stats"]["armor"];
					$new_champion->mpregenperlevel = $champion["stats"]["mpregenperlevel"];
					$new_champion->hpregen = $champion["stats"]["hpregen"];
					$new_champion->critperlevel = $champion["stats"]["critperlevel"];
					$new_champion->spellblockperlevel = $champion["stats"]["spellblockperlevel"];
					$new_champion->mpregen = $champion["stats"]["mpregen"];
					$new_champion->attackspeedperlevel = $champion["stats"]["attackspeedperlevel"];
					$new_champion->spellblock = $champion["stats"]["spellblock"];
					$new_champion->movespeed = $champion["stats"]["movespeed"];
					$new_champion->attackspeedoffset = $champion["stats"]["attackspeedoffset"];
					$new_champion->crit = $champion["stats"]["crit"];
					$new_champion->hpregenperlevel = $champion["stats"]["hpregenperlevel"];
					$new_champion->armorperlevel = $champion["stats"]["armorperlevel"];
					$new_champion->lore = $champion["lore"];
					$i = 0;
					foreach($champion["enemytips"] as $tip){
						$i = $i+1;
						if($i==1){
							$new_champion->enemytips1= $tip;
						}
						if($i==2){
							$new_champion->enemytips2= $tip;
						}
						if($i==3){
							$new_champion->enemytips3= $tip;
						}
					}
					$i = 0;
					foreach($champion["allytips"] as $tip2){
						$i = $i+1;
						if($i==1){
							$new_champion->allytips1= $tip2;
						}
						if($i==2){
							$new_champion->allytips2= $tip2;
						}
						if($i==3){
							$new_champion->allytips3= $tip2;
						}
					}
					$new_champion->save();
					
				}else{
					$champion_data = "https://euw.api.pvp.net/api/lol/euw/v1.2/champion/".$champion["id"]."?api_key=".$api_key;
					$json2 = @file_get_contents($champion_data);
					if($json2 === FALSE) {
						return View::make('login');
					} else {
						$data = json_decode($json2, true);
						if($data["freeToPlay"] != $recent_champion->f2p){
							$recent_champion->f2p = $data["freeToPlay"];
						}
						$recent_champion->save();
					}
				}
				unset($recent_champion);
				
				foreach($champion["skins"] as $skin){
						$recent_skin = Skin::where('champion_id', '=', $champion["id"])->where('skin_id', '=', $skin['num'])->first();
						
						if(!isset($recent_skin)) {
							$new_skin = new Skin;
							$new_skin->name = $skin['name'];
							$new_skin->champion_id = $champion["id"];
							$new_skin->skin_id = $skin['num'];
							$new_skin->save();
						}
					unset($recent_skin);
				}
				
				foreach($champion["spells"] as $skill){
						$recent_skill = Skill::where('champion_id', '=', $champion["id"])->where('name', '=', $skill['name'])->first();
						
						if(!isset($recent_skill)) {
							$recent_skill = new Skill;
							$recent_skill->name = $skill['name'];
							$recent_skill->champion_id = $champion["id"];
							$recent_skill->description = $skill['description'];
							$recent_skill->icon = $skill['image']['full'];
							$recent_skill->save();
						}
					unset($recent_skill);
				}
			}
		}
		
		//echo "\n\nChampions refreshed\n\n";
	}


}