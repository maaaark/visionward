<?php

class LeaguesController extends \BaseController {

	/**
	 * Display a listing of leagues
	 *
	 * @return Response
	 */
	public function index()
	{
		$leagues = League::all();

		return View::make('leagues.index', compact('leagues'));
	}

	/**
	 * Show the form for creating a new league
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('leagues.create');
	}

	/**
	 * Store a newly created league in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), League::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		League::create($data);

		return Redirect::route('leagues.index');
	}

	/**
	 * Display the specified league.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $slug)
	{
		$league = League::findOrFail($id);
		$matches = Match::where("league_id", "=", $league->id)->where("parent_game", "=", 0)->orderBy("game_date", "DESC")->get();

		return View::make('leagues.show', compact('league'));
	}

	/**
	 * Show the form for editing the specified league.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$league = League::find($id);

		return View::make('leagues.edit', compact('league'));
	}

	/**
	 * Update the specified league in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$league = League::findOrFail($id);

		$validator = Validator::make($data = Input::all(), League::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$league->update($data);

		return Redirect::route('leagues.index');
	}

	/**
	 * Remove the specified league from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		League::destroy($id);

		return Redirect::route('leagues.index');
	}

}
