<?php

class MatchesController extends \BaseController {

	/**
	 * Display a listing of matches
	 *
	 * @return Response
	 */
	public function index()
	{
        
        $eulcs = Match::orderBy("game_date", "DESC")->where("parent_game", "=", "0")->where("league_id", "=",11)->paginate(12);
        $others = Match::orderBy("game_date", "DESC")->where("parent_game", "=", "0")
            ->where("league_id", "=",40)
            ->orWhere('league_id', 41)
            ->orWhere('league_id', 43)
            ->paginate(12);
        $nalcs = Match::orderBy("game_date", "DESC")->where("parent_game", "=", "0")->where("league_id", "=",19)->paginate(12);
        
		$date_now = new DateTime('today');
		return View::make('matches.index', compact('date_now', 'eulcs', 'nalcs', 'others'));
	}

	/**
	 * Show the form for creating a new match
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('matches.create');
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

		return Redirect::route('matches.index');
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

		return View::make('matches.edit', compact('match'));
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

		return Redirect::route('matches.index');
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

		return Redirect::route('matches.index');
	}

}
