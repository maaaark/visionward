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
				$array = array(0 => array(), 1 => array());
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
						$mastery_object->ranks        = $mastery["ranks"];
						$mastery_object->prereq       = $mastery["prereq"];
						$mastery_object->save();
						$count++;

						$temp = array();
						$temp["mastery_id"]   = $mastery["id"];
						$temp["name"]		  = $mastery["name"];
						$temp["mastery_tree"] = $mastery["masteryTree"];
						$temp["description"]  = $mastery["description"][0];
						$temp["ranks"]		  = $mastery["ranks"];
						$temp["prereq"]		  = $mastery["prereq"];
						$array[0][$mastery["id"]] = $temp;
					}
				}
			}
			echo "Es wurden ".$count." Meisterschaften gespeichert".PHP_EOL;

			if(isset($json["tree"]) && is_array($json["tree"])){
				MasteryTree::truncate();
				foreach($json["tree"] as $type => $arr){
					foreach($arr as $row => $element){
						if(isset($element["masteryTreeItems"]) && is_array($element["masteryTreeItems"])){
							foreach($element["masteryTreeItems"] as $column => $mastery){
								if(isset($mastery["masteryId"]) && $mastery["masteryId"] > 0){
									$mastery_tree = new MasteryTree;
									$mastery_tree->mastery_id = $mastery["masteryId"];
									$mastery_tree->prereq     = $mastery["prereq"];
									$mastery_tree->type       = $type;
									$mastery_tree->column     = $column;
									$mastery_tree->row        = $row;
									$mastery_tree->save();
								}
							}
						}
					}
				}
				echo "Meisterschafts-Tree Infos wurden zurückgesetzt und neu gespeichert.".PHP_EOL;
				$array[1] = $json["tree"];
			}

			File::put("public/masteries.json", json_encode($array));
		}
	}

}
