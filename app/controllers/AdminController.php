<?php

class AdminController extends \BaseController {
	
	public function index()
	{
		if(Auth::check()) {
			return View::make("admin.index");
		} else {
			return View::make("admin.login");
		}
	}
	
	public function news() {
		$posts = Post::all();
		return View::make("admin.news.index", compact("posts"));
	}
	
	public function news_show($id) {
		$post = Post::find($id);
		$categories = Category::all();
		return View::make("admin.news.show", compact("post", "categories"));
	}
	
	public function save_news() {
		if(Auth::check()) {
			$news = Post::find(Input::get('news_id'));
			$news->content = Input::get('content');
			$news->published = Input::get('published');
			$news->title = Input::get('title');
			
			foreach($news->categories as $news_category) {
				$news->categories()->detach($news_category->id);
			}
			
			$categories = Input::get('category');
			if(is_array($categories))
			{
			   foreach($categories as $category) {
					$news->categories()->attach($category);
			   }
			}

			$news->save();
			return Redirect::to("/admin/news/".$news->id)->with("success", "News gespeichert");
		} else {
			return Redirect::to('/admin');
		}
	}
	
	public function logout()
	{
		Auth::logout();
		return Redirect::to("/admin")->with("success", "Du wurdest ausgeloggt");
	}
	
	public function doLogin()
	{
		// validate the info, create rules for the inputs
		$rules = array(
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('/admin')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password')
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) {

				// validation successful!
				// redirect them to the secure section or whatever
				// return Redirect::to('secure');
				// for now we'll just echo success (even though echoing in a controller is bad)
				return Redirect::to("/admin");

			} else {	 	

				// validation not successful, send back to form	
				return Redirect::to('/admin');

			}

		}
	}

}