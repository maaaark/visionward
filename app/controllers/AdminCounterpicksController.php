<?php

class AdminCounterpicksController extends \BaseController {


	public function index()
	{
		$counterpicks = Counterpick::orderBy("counter_champion_id", "ASC")->get();
		$champions = Champion::orderBy("name", "ASC")->get();
		return View::make('admin.counterpicks.index', compact('counterpicks', 'champions'));
	}

	public function edit($id)
	{
		$counterpick = Counterpick::find($id);
		$champions = Champion::orderBy("name", "ASC")->get();
		
		return View::make('admin.counterpicks.edit', compact('counterpick', 'champions'));
	}

	public function update($id)
	{
		$counterpick = Counterpick::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Counterpick::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		if(Input::get('upvotes') && Input::get('downvotes')) {
			$counterpick->votes = Input::get('upvotes')-Input::get('downvotes');
			$counterpick->save();
		}
		
		$counterpick->update($data);

		return Redirect::route('admin.counterpicks.index')->with("success", "Erolgreich gespeichert");
	}


}
