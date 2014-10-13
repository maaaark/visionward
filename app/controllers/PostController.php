<?php

class PostController extends BaseController {

	public function index()
	{
		$posts = Post::orderBy('created_at', 'DESC')->where("published", "=", 1)->get();
		return View::make('posts.index', compact('posts'));
	}
	
	public function show($id)
	{
		$post = Post::findOrFail($id);
		return View::make('posts.show', compact('post'));
	}

}