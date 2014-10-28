<?php

class AdminPostsController extends \BaseController {
	
	public function index() {
		$posts = Post::orderBy("created_at", "DESC")->get();
		return View::make("admin.news.index", compact("posts"));
	}
	
	public function edit($id) {
		$post = Post::find($id);
		$categories = Category::all();
		$galleries = Gallery::all();
		return View::make("admin.news.show", compact("post", "categories", "galleries"));
	}
	
	
	public function create() {
		$categories = Category::all();
		$galleries = Gallery::all();
		return View::make("admin.news.create", compact("categories", "galleries"));
	}
	
	public function save() {
		$input = Input::all();
		$categories = Input::get('category');
		$input["slug"] = Str::slug(Input::get('title'));
		$validation = Validator::make($input, Post::$rules);

		if ($validation->passes())
		{	
	        $post = Post::create($input);
			
			foreach($post->categories as $news_category) {
				$post->categories()->detach($news_category->id);
			}
			
			if(is_array($categories))
			{
			   foreach($categories as $category) {
					$post->categories()->attach($category);
			   }
			}
			
			return Redirect::to('/admin/news')->with("success", "News erstellt");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/news/create")
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all())->with('categories', $categories);
		}
        
	}
	
	public function update() {
		$input = Input::all();
		$categories = Input::get('category');
		$input["slug"] = Str::slug(Input::get('title'));
		
		$validation = Validator::make($input, Post::$update_rules);
		if ($validation->passes())
		{
			$post = Post::find(Input::get('id'));
			
			if(Input::file('image')) {
				$file = Input::file('image');
				$filename = $file->getClientOriginalName();
		        $destinationPath = public_path()."/uploads/news/";
        
		        $mime_type = $file->getMimeType();
		        $extension = $file->getClientOriginalExtension();
		        $upload_success = $file->move($destinationPath, $filename);
				$input["image"] = $filename;
			} else {
				$input["image"] = $post->image;
			}
			
			if(!Input::get('corrected')) {
				$input["corrected"] = 0;
			}
			if(!Input::get('published')) {
				$input["published"] = 0;
			}
			
			// Category
			foreach($post->categories as $news_category) {
				$post->categories()->detach($news_category->id);
			}
			
			$categories = Input::get('category');
			if(is_array($categories))
			{
			   foreach($categories as $category) {
					$post->categories()->attach($category);
			   }
			}
			
			$post->update($input);
			
	        return Redirect::to('/admin/news/edit/'.Input::get('id'))->with("success", "News geupdated");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/news/edit/".Input::get('id'))
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all())->with('categories', $categories);
		}
        
	}
	
	public function destroy($id)
    {
        $post = Post::find($id);
		foreach($post->categories() as $category) {
			$category->post->detach($category->id);
		}
		$post->delete();
        return Redirect::to('/admin/news')->with("success", "News wurde gelöscht");
    }
	
}