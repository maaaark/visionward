<?php

class PostController extends BaseController {

	public function index()
	{
		$posts = Post::orderBy('created_at', 'DESC')->where("published", "=", 1)->paginate(13);
		$slider = Slider::all();
		return View::make('posts.index', compact('posts', 'slider'));
	}
	
	public function show($id, $slug)
	{
		$post = Post::findOrFail($id);
		return View::make('posts.show', compact('post'));
	}

}