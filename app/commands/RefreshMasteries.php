<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshMasteries extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:masteries';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refreshing Masteries from Riot-API.';

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
		
		$mastery_data = "https://global.api.pvp.net/api/lol/static-data/euw/v1.2/mastery?locale=de_DE&masteryListData=all&api_key=".$api_key;
		$json = @file_get_contents($mastery_data);
		
		if($json === FALSE) {
			return Redirect::to('404');
		} else {
			$json = json_decode($json, true);

			$count = 0;
			if(isset($json["data"]) && is_array($json["data"])){
				foreach($json["data"] as $mastery){
					if(isset($mastery["id"])){
						$mastery_object = Mastery::where("mastery_id", "=", $mastery["id"])->first();
						if(!$mastery_object){
							$mastery_object = new Mastery;
						}
						$mastery_object->mastery_id   = $mastery["id"];
						$mastery_object->name    	  = $mastery["name"];
						$mastery_object->mastery_tree = $mastery["masteryTree"];
						$mastery_object->description  = $mastery["description"][0];
						$mastery_object->save();
						$count++;
					}
				}
			}
			echo "Es wurden ".$count." Meisterschaften gespeichert".PHP_EOL;
		}
	}

}
