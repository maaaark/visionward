<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Run extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'run:function';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'custom function';

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
		$leagues = League::all();
		foreach($leagues as $league) {

			$league->slug = Str::slug($league->name);
			$league->save();
		}
		echo "Team Slugs gespeichert\n";
	}
}