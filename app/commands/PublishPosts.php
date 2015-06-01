<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PublishPosts extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'publish:posts';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish scheduled news';

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
		$scheduled_posts = Post::where("schedule_check", "=", true)->where("published", "=", false)->get();
		$date_now = new DateTime('now');
		foreach($scheduled_posts as $post) {
			if($post->schedule_time <= $date_now) {
				echo "\n".$post->title." wurde veröffenlticht\n";
				$post->published = 1;
				$post->save();
			}
		}
	}
}