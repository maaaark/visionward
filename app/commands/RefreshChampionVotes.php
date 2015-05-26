<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshChampionVotes extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:championvotes';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refreshing Votes for all Champions';

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
		$champions = Champion::all();
		foreach($champions as $champion) {
			$votes = 0;
			
			$counterpicks = Counterpick::where("champion_id", "=", $champion->champion_id)->get();
			foreach($counterpicks as $pick) {
				$votes = $votes + $pick->upvotes + $pick->downvotes;
			}
			
			$champion->votes = $votes;
			$champion->save();
			//echo $votes." Votes für ".$champion->name." gespeichert\n";
		}
	}


}
