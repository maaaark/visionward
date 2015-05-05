<?php

class AdminController extends \BaseController {
	
	public function index()
	{
		if(Auth::check()) {
            if(Auth::user()->hasRole("admin")) {
                $users = User::orderBy("newscount", "DESC")->get();
                return View::make("admin.index", compact('users'));
            } else {
                return Redirect::to("/")->with("error", "Kein Zugriff");
            }
		} else {
			return View::make("admin.login");
		}
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to("/")->with("success", "Du wurdest ausgeloggt");
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