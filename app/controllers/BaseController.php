<?php

class BaseController extends Controller {
	
	
    public function __construct()
	{

		//$settings = Setting::all();
		$last_posts = Post::where("published", "=", 1)->orderBy("created_at", "DESC")->limit(3)->get();
		$matches = Match::orderBy("game_date", "DESC")->limit(3)->get();
		$champion_sales = Champion::orderBy("name", "ASC")->where("sale", true)->get();
		$skin_sales = Skin::orderBy("name", "ASC")->where("sale", true)->get();
		$transfers = PlayerHistory::orderBy("created_at", "DESC")->limit(3)->get();
		$patchversion = Setting::where('key', '=', 'patch_number')->first();

		View::share('champion_sales', $champion_sales);
		View::share('skin_sales', $skin_sales);
		View::share('matches', $matches);
		View::share('last_posts', $last_posts);
		View::share('transfers', $transfers);
		View::share('patchversion', $patchversion);
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