<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshRunes extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:runes';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refreshing Runes from Riot-API.';

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
		
		$runes_data = "https://global.api.pvp.net/api/lol/static-data/euw/v1.2/rune?locale=de_DE&masteryListData=all&api_key=".$api_key;
		$json = @file_get_contents($runes_data);
		
		if($json === FALSE) {
			return Redirect::to('404');
		} else {
			$json = json_decode($json, true);

			$count = 0;
			if(isset($json["data"]) && is_array($json["data"])){
				foreach($json["data"] as $rune){
					if(isset($rune["id"])){
						$rune_object = Rune::where("rune_id", "=", $rune["id"])->first();
						if(!$rune_object){
							$rune_object = new Rune;
						}
						$rune_object->rune_id	   = $rune["id"];
						$rune_object->name    	   = $rune["name"];
						//$rune_object->mastery_tree = $rune["masteryTree"];
						$rune_object->description  = $rune["description"];
						$rune_object->save();
						$count++;
					}
				}
			}
			echo "Es wurden ".$count." Runen gespeichert".PHP_EOL;
		}
	}

}
