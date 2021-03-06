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
		$data = Input::all();
		$validator = Validator::make($data, Player::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		if(Input::file('picture')) {
			$file = Input::file('picture');
			
			$filename = $file->getClientOriginalName();
			$destinationPath = public_path()."/img/players/";
	
			$mime_type = $file->getMimeType();
			$extension = $file->getClientOriginalExtension();
			$upload_success = $file->move($destinationPath, $filename);
			$data["picture"] = $filename;
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
		return View::make('admin.players.edit', compact('player', 'teams'));
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
		$data = Input::all();
		$validator = Validator::make($data = Input::all(), Player::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		if($data["team_id"] != $player->team_id || $data["role"] != $player->role) {
			$change = new PlayerHistory;
			$change->player_id = $player->id;
			$change->team_id = $data["team_id"];
			$change->old_team_id = $player->team_id;
			$change->old_role = $player->role;
			$change->join_date = new DateTime('today');
			$change->save();
		}
		
		
		if(Input::file('picture')) {
			$file = Input::file('picture');
			
			$filename = $file->getClientOriginalName();
			$destinationPath = public_path()."/img/players/";
	
			$mime_type = $file->getMimeType();
			$extension = $file->getClientOriginalExtension();
			$upload_success = $file->move($destinationPath, $filename);
			$data["picture"] = $filename;
		} else {
			$data["picture"] = $player->picture;
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
