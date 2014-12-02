<?php

class PostController extends BaseController {

	public function index()
	{
		$posts = Post::orderBy('created_at', 'DESC')->where("published", "=", 1)->paginate(13);
		$slider = Slider::where("published", "=", 1)->orderBy("order", "ASC")->get();
		
		return View::make('posts.index', compact('posts', 'slider'));
	}
	
	public function show($id, $slug)
	{
		$post = Post::findOrFail($id);
		return View::make('posts.show', compact('post'));
	}
	
	public function archive()
	{
		$posts = Post::orderBy('created_at', 'DESC')->where("published", "=", 1)->skip(13)->paginate(25);
		$slider = Slider::where("published", "=", 1)->orderBy("order", "ASC")->get();
		
		return View::make('posts.archive', compact('posts', 'slider'));
	}

}