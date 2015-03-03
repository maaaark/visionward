<?php

class AdminLeaguesController extends \BaseController {

	/**
	 * Display a listing of matches
	 *
	 * @return Response
	 */
	public function index()
	{
		$leagues = League::all();
		return View::make('admin.leagues.index', compact('leagues'));
	}

	/**
	 * Show the form for creating a new match
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.leagues.create');
	}

	/**
	 * Store a newly created match in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();

		League::create($data);

		return Redirect::route('admin.leagues.index')->with("success", "Erolgreich gespeichert");
	}

	/**
	 * Display the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$league = League::findOrFail($id);

		return View::make('admin.leagues.show', compact('league'));
	}
	
	
	public function new_standing()
	{
		return View::make('admin.leagues.new_standing');
	}
	
	
	/**
	 * Show the form for editing the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$league = League::find($id);
        
		return View::make('admin.leagues.edit', compact('league'));
	}
	
	public function edit_standing($id)
	{
		$standing = LeagueStanding::findOrFail($id);
        
		return View::make('admin.leagues.edit_standings', compact('standing'));
	}
	
	public function create_standing()
	{
		$standing = new LeagueStanding;
        $data = Input::all();
		$standing->fill($data);
		$standing->save();
		
        $leagues = League::all();
		
		return View::make('admin.leagues.index', compact('leagues'))->with("success", "Erolgreich gespeichert");
	}
	
	
	/**
	 * Update the specified match in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$league = League::findOrFail($id);
        $data = Input::all();
		$league->update($data);

		return Redirect::route('admin.leagues.index')->with("success", "Erolgreich gespeichert");
	}
		
	public function update_standing($id)
	{
		$standing = LeagueStanding::findOrFail($id);
        $data = Input::all();
		$standing->update($data);

		return Redirect::route('admin.leagues.index')->with("success", "Erolgreich gespeichert");
	}	
	
	
	/**
	 * Remove the specified match from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		League::destroy($id);

		return Redirect::route('admin.leagues.index');
	}

}
