<?php

class AdminMatchesController extends \BaseController {

	/**
	 * Display a listing of matches
	 *
	 * @return Response
	 */
	public function index()
	{
		$matches = Match::orderBy("game_date", "ASC")->get();
		$date_now = new DateTime('today');
		return View::make('admin.matches.index', compact('matches', 'date_now'));
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
		return View::make('admin.matches.create', compact('leagues', 'teams'));
	}

	/**
	 * Store a newly created match in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Match::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Match::create($data);

		return Redirect::route('admin.matches.index')->with("success", "Erolgreich gespeichert");
	}

	/**
	 * Display the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$match = Match::findOrFail($id);

		return View::make('matches.show', compact('match'));
	}

	/**
	 * Show the form for editing the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$match = Match::find($id);
		$teams = Team::all();
		$leagues = League::all();
		
		return View::make('admin.matches.edit', compact('match', 'leagues', 'teams'));
	}

	/**
	 * Update the specified match in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$match = Match::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Match::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$match->update($data);

		return Redirect::route('admin.matches.index')->with("success", "Erolgreich gespeichert");
	}

	/**
	 * Remove the specified match from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Match::destroy($id);

		return Redirect::route('admin.matches.index');
	}

}
