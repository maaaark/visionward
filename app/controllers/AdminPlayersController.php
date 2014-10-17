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
		return View::make('admin.players.create', compact('teams'));
	}

	/**
	 * Store a newly created match in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Player::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Player::create($data);

		return Redirect::route('admin.players.index')->with("success", "Erolgreich gespeichert");
	}


	/**
	 * Show the form for editing the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$player = Player::find($id);
		$teams = Team::all();
		return View::make('admin.teams.edit', compact('player', 'teams'));
	}

	/**
	 * Update the specified match in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$player = Player::findOrFail($id);
		$data = Input::all()
		$validator = Validator::make($data = Input::all(), Player::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		if($data["team_id"] != $player->team_id) {
			// 
		}
		$player->update($data);

		return Redirect::route('admin.players.index')->with("success", "Erolgreich gespeichert");
	}

	/**
	 * Remove the specified match from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Player::destroy($id);

		return Redirect::route('admin.players.index');
	}

}
