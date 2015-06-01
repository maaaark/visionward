<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;
	
class CountPosts extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'count:posts';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Count news posts';

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
		//
		$users = User::all();
		$date_now = new DateTime('now');
		$posts = Post::where("created_at", ">=", Carbon::now()->subDays(14))->get();
		
		foreach($users as $user) {
			$i = 0;
			foreach($posts as $post) {
				if($post->created_at <= $date_now && $post->published == true && $post->user_id == $user->id) {
					$i++;
				}
			}
			$user->newscount = $i;
			$user->save();
		}
	}
}