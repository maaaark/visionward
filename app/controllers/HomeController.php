<?php

class HomeController extends BaseController {

	public function showWelcome()
	{
		$posts = Post::all();
		return View::make('hello', compact('posts'));
	}
	
	public function team()
	{
		return View::make('pages.team');
	}

}