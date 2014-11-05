<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshItems extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:items';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refreshing Items from API';

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
		
		$item_data = "https://global.api.pvp.net/api/lol/static-data/euw/v1.2/item?locale=de_DE&itemListData=stats&api_key=".$api_key;
		$json = @file_get_contents($item_data);
		
		if($json === FALSE) {
			return Redirect::to('404');
		} else {
			$obj = json_decode($json, true);
			
			foreach($obj["data"] as $key => $item) {
				$recent_item = Item::where('item_id', '=', $item["id"])->first();
				
				if(!isset($recent_item)) {
					$new_item = new Item;
					echo "Saved Item ".$item["name"]." ********** NEW ITEM<br/>";
				} else {
					$new_item = $recent_item;
				}
				
				if(!isset($item["plaintext"])) {
					$plaintext = "";
				}
				
				$new_item->id = $item["id"];
				$new_item->item_id = $item["id"];
				$new_item->riot_id = $item["id"];
				
				$new_item->description = $item["description"];
				$new_item->plaintext = $plaintext;
				$new_item->name = $item["name"];
				
				$new_item->save();
					
					
				unset($recent_item);
			}
		}
		
		//echo "\n\nItems refreshed\n\n";
	}

}
