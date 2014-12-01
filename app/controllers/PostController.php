<?php

class PostController extends BaseController {

	public function index()
	{
		$posts = Post::orderBy('created_at', 'DESC')->where("published", "=", 1)->paginate(13);
		$slider = Slider::where("published", "=", 1)->orderBy("order", "ASC")->get();
		
		if(array_key_exists('page', $_GET)) {
			$page = intval($_GET['page']);
		} else {
			$page = 1;
		}
		
		
		return View::make('posts.index', compact('posts', 'slider', 'page'));
	}
	
	public function show($id, $slug)
	{
		$post = Post::findOrFail($id);
		return View::make('posts.show', compact('post'));
	}

}