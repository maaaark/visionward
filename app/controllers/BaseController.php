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