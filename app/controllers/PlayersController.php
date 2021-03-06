<?php

class PlayersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /players
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /players/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /players
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /players/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $slug)
	{
		$player = Player::find($id);
		return View::make('players.show', compact('player'));
	}
	
	public function transferlist()
	{
		$transfers = PlayerHistory::orderBy("created_at", "DESC")->paginate(25);
		return View::make('players.transferlist', compact('transfers'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /players/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /players/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /players/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function tooltip($id)
	{
		$player = Player::find($id);
		return Response::json(array('player' => $player, 'team' => $player->team));
	}
}