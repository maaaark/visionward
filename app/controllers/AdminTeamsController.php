<?php

class AdminTeamsController extends \BaseController {

	/**
	 * Display a listing of matches
	 *
	 * @return Response
	 */
	public function index()
	{
		$teams = Team::all();
		return View::make('admin.teams.index', compact('teams'));
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
		
		$team = new Team;
		$team->save();
		$leagues = Input::get('league');
		if(is_array($leagues))
		{
		   foreach($leagues as $league) {
				$team->leagues()->attach($league);
		   }
		}
		
		if(Input::file('logo')) {
			$file = Input::file('logo');
			
			$filename = $file->getClientOriginalName();
			$destinationPath = public_path()."/img/teams/logos/";
	
			$mime_type = $file->getMimeType();
			$extension = $file->getClientOriginalExtension();
			$upload_success = $file->move($destinationPath, $filename);
			$data["logo"] = $filename;
		}
			
		$team->name = Input::get('name');
		$team->country = Input::get('country');
		$team->region = Input::get('region');
		$team->description = Input::get('description');
		$team->save();
		
			
		//Team::create($data);

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
		$data = Input::all();
		// Role
			foreach($team->leagues as $league) {
				$team->leagues()->detach($league->id);
			}
			
			$leagues = Input::get('league');
			if(is_array($leagues))
			{
			   foreach($leagues as $league) {
					$team->leagues()->attach($league);
			   }
			}

		$validator = Validator::make($data, Team::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		if(Input::file('logo')) {
			$file = Input::file('logo');
			
			$filename = $file->getClientOriginalName();
			$destinationPath = public_path()."/img/teams/logos/";
	
			$mime_type = $file->getMimeType();
			$extension = $file->getClientOriginalExtension();
			$upload_success = $file->move($destinationPath, $filename);
			$team->logo = $filename;
		} else {
			$data["logo"] = $team->logo;
		}
		
		$team->name = Input::get('name');
		$team->country = Input::get('country');
		$team->region = Input::get('region');
		$team->description = Input::get('description');
		$team->save();
		//$team->update($data);

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
