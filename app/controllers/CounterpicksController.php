<?php

class CounterpicksController extends \BaseController {

	/**
	 * Display a listing of counterpicks
	 *
	 * @return Response
	 */
	public function index()
	{
		$counterpicks = Counterpick::all();

		return View::make('counterpicks.index', compact('counterpicks'));
	}

	/**
	 * Show the form for creating a new counterpick
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('counterpicks.create');
	}

	/**
	 * Store a newly created counterpick in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Counterpick::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Counterpick::create($data);

		return Redirect::route('counterpicks.index');
	}

	/**
	 * Display the specified counterpick.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $key)
	{
		$champion = Champion::where("champion_id", "=", $id)->first();
		
		$good = Counterpick::where("type", "=", "good")->where("champion_id", "=", $id)->get();
		$bad = Counterpick::where("type", "=", "bad")->where("champion_id", "=", $id)->get();
		
		return View::make('counterpicks.show', compact('champion', 'good', 'bad'));
	}
	
	public function details($id, $key, $counter_champion_id, $counter_champion_key)
	{
		$champion = Champion::where("champion_id", "=", $id)->first();
		$counter = Champion::where("champion_id", "=", $counter_champion_id)->first();
		
		$counterpick = Counterpick::where("champion_id", "=", $id)->where("counter_champion_id", "=", $counter_champion_id)->first();
		
		return View::make('counterpicks.details', compact('champion', 'counter', 'counterpick'));
	}

	/**
	 * Show the form for editing the specified counterpick.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$counterpick = Counterpick::find($id);

		return View::make('counterpicks.edit', compact('counterpick'));
	}

	/**
	 * Update the specified counterpick in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$counterpick = Counterpick::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Counterpick::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$counterpick->update($data);

		return Redirect::route('counterpicks.index');
	}

	/**
	 * Remove the specified counterpick from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Counterpick::destroy($id);

		return Redirect::route('counterpicks.index');
	}

}
