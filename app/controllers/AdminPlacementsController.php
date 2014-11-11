<?php

class AdminPlacementsController extends \BaseController {

	/**
	 * Display a listing of matches
	 *
	 * @return Response
	 */
	public function index()
	{
		$placements = Placement::all();
		return View::make('admin.placements.index', compact('placements'));
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
		return View::make('admin.placements.create', compact('leagues', 'teams'));
	}

	/**
	 * Store a newly created match in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();

		Placement::create($data);

		return Redirect::route('admin.placements.index')->with("success", "Erolgreich gespeichert");
	}

	/**
	 * Display the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$placement = Placement::findOrFail($id);

		return View::make('placements.show', compact('placement'));
	}

	/**
	 * Show the form for editing the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$placement = Placement::find($id);
		$teams = Team::all();
		$leagues = League::all();
        
		return View::make('admin.placements.edit', compact('placement', 'leagues', 'teams'));
	}

	/**
	 * Update the specified match in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$placement = Placement::findOrFail($id);
        $data = Input::all();


		$placement->update($data);

		return Redirect::route('admin.placements.index')->with("success", "Erolgreich gespeichert");
	}

	/**
	 * Remove the specified match from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Placement::destroy($id);

		return Redirect::route('admin.placements.index');
	}

}
