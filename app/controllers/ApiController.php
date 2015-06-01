<?php

class ApiController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function news()
	{
		$news = Post::orderBy("id", "DESC")->get();
		$api = Response::json($news);
		return $api;
	}
	
	public function show($id)
	{
		$user = User::find($id);
		$api = Response::json($user);
		return $api;
	}
	
	
	public function champions()
	{
		$champions = Champion::orderBy('name')->get();
		return Response::json(array(
			'error' => false,
			'champions' => $champions->toArray()),
			200
		);

	}
	
}
