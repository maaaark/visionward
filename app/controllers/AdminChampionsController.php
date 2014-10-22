<?php

class AdminChampionsController extends \BaseController {


	public function index()
	{
		$champions = Champion::orderBy("name", "ASC")->get();
		return View::make('admin.champions.index', compact('champions'));
	}

	public function edit($id)
	{
		$champion = Champion::find($id);
		
		return View::make('admin.champions.edit', compact('champion'));
	}

	public function update($id)
	{
		$champion = Champion::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Champion::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		if(!Input::get('f2p')) {
			$data["f2p"] = 0;
		}
		if(!Input::get('sale')) {
			$data["sale"] = 0;
		}
		
		$champion->update($data);

		return Redirect::route('admin.champions.index')->with("success", "Erolgreich gespeichert");
	}


}
