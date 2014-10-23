<?php

class BaseController extends Controller {
	
	
    public function __construct()
	{
	   // Build our navigation
	   $settings = Cache::get('settings', function()
	   {
	       $settings = Setting::all();
	       Cache::forever('settings', $settings);
	       return $settings;
	   });
	   View::share('settings', $settings);
	   
	   // Build our navigation
	   $last_posts = Cache::get('last_posts', function()
	   {
	       $last_posts = Post::where("published", "=", 1)->orderBy("created_at", "DESC")->limit(5)->get();
	       Cache::forever('last_posts', $last_posts);
	       return $last_posts;
	   });
	   View::share('last_posts', $last_posts);
	   
	   
	   // Matches
	   $matches = Cache::get('matches', function()
	   {
	       $matches = Match::orderBy("game_date", "DESC")->limit(3)->get();
	       Cache::forever('matches', $matches);
	       return $matches;
	   });
	   View::share('matches', $matches);
	   
	   
	   // Transfers
	   $transfers = Cache::get('transfers', function()
	   {
	       $transfers = PlayerHistory::orderBy("join_date", "DESC")->limit(3)->get();
	       Cache::forever('transfers', $transfers);
	       return $transfers;
	   });
	   View::share('transfers', $transfers);
	   
	   // sale
	   $champion_sales = Cache::get('champion_sales', function()
	   {
	       $champion_sales = Champion::orderBy("name", "ASC")->where("sale", "1")->get();
	       Cache::forever('champion_sales', $champion_sales);
	       return $champion_sales;
	   });
	   View::share('champion_sales', $champion_sales);
	   
	   
	}

	   
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}