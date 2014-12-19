<?php

class AdminController extends \BaseController {
	
	public function index()
	{
		if(Auth::check()) {
			$users = User::orderBy("newscount", "DESC")->get();
			return View::make("admin.index", compact('users'));
		} else {
			return View::make("admin.login");
		}
	}
	
	/*
	public function save_news() {
		if(Auth::check()) {
			$input = Input::all();
			$validation = Validator::make($input, Category::$rules);

			if ($validation->passes())
			{
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
				$messages = $validation->messages();
				return Redirect::to('/admin/news/create')
				->withInput()
				->withErrors($validation)
				->with('error', 'There were validation errors.');
			}
			
		} else {
			return Redirect::to('/admin');
		}
	}
	*/
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