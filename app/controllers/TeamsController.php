<?php

class TeamsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /teams
	 *
	 * @return Response
	 */
	public function index()
	{
		$eulcs = League::find(1);
		$nalcs = League::find(2);
		$ogn = League::find(3);
		$gpl = League::find(4);
		$lpl = League::find(5);
		$lms = League::find(38);
		$challenger = League::find(6);
		return View::make('teams.index', compact('eulcs', 'nalcs', 'ogn', 'gpl', 'lpl', 'challenger', 'lms'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /teams/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /teams
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /teams/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $slug)
	{
		$team = Team::find($id);
		$top = $team->getRole("top");
		$jungle = $team->getRole("jungle");
		$mid = $team->getRole("mid");
		$adc = $team->getRole("adcarry");
		$support = $team->getRole("support");
		$coach = $team->getRole("coach");
		$sub = $team->getRole("sub");
		$placements = Placement::where("team_id", "=", $team->id)->orderBy("order", "ASC")->get();
		return View::make('teams.show', compact('team', 'top', 'jungle', 'mid', 'adc', 'support', 'sub', 'coach', 'placements'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /teams/{id}/edit
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
	 * PUT /teams/{id}
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
	 * DELETE /teams/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}