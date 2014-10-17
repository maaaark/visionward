<?php

class AdminPlayersController extends \BaseController {

	/**
	 * Display a listing of matches
	 *
	 * @return Response
	 */
	public function index()
	{
		$players = Player::all();
		return View::make('admin.players.index', compact('players'));
	}

	/**
	 * Show the form for creating a new match
	 *
	 * @return Response
	 */
	public function create()
	{
		$teams = Team::all();
		$leagues = League::all();
		return View::make('admin.teams.create', compact('leagues', 'teams'));
	}

	/**
	 * Store a newly created match in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Team::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Team::create($data);

		return Redirect::route('admin.teams.index')->with("success", "Erolgreich gespeichert");
	}


	/**
	 * Show the form for editing the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$team = Team::find($id);
		$leagues = League::all();
		return View::make('admin.teams.edit', compact('team', 'leagues'));
	}

	/**
	 * Update the specified match in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$team = Team::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Team::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$team->update($data);

		return Redirect::route('admin.teams.index')->with("success", "Erolgreich gespeichert");
	}

	/**
	 * Remove the specified match from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Team::destroy($id);

		return Redirect::route('admin.teams.index');
	}

}
