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
		$settings = Setting::all();
		
		View::share('global_champion_sales', $champion_sales);
		View::share('global_skin_sales', $skin_sales);
		View::share('global_matches', $matches);
		View::share('global_last_posts', $last_posts);
		View::share('global_transfers', $transfers);
		View::share('patchversion', $patchversion['attributes']['value']);
		View::share('global_settings', $settings);
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
	
	protected function _generateNewsResult($searchString)
	{
		//var_dump($searchString);
		$searches = DB::table('posts')
			->where('title', 'LIKE', '%'.$searchString.'%')
			->orWhere('content', 'LIKE', '%'.$searchString.'%')
			->get();
			
		//$countResult = count($results);
		//foreach($results as $result) {
		//	var_dump($result->title);
		//}
		//var_dump($countResult);die("qwe");
		return $searches;
	}
	
	protected function _generateChampResult($searchString)
	{
		$searches = DB::table('champions')
			->where('name', 'LIKE', '%'.$searchString.'%')
			->orWhere('key', 'LIKE', '%'.$searchString.'%')
			->orWhere('title', 'LIKE', '%'.$searchString.'%')
			->get();
		return $searches;
	}
	
	protected function _generatePlayerResult($searchString)
	{
		$searches = DB::table('players')
			->where('nickname', 'LIKE', '%'.$searchString.'%')
			->orWhere('first_name', 'LIKE', '%'.$searchString.'%')
			->orWhere('last_name', 'LIKE', '%'.$searchString.'%')
			->get();
		return $searches;
	}
	
	protected function _generateTeamResult($searchString)
	{
		$searches = DB::table('teams')
			->where('name', 'LIKE', '%'.$searchString.'%')
			->get();
		return $searches;
	}

}