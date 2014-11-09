<?php

class SummonersController extends \BaseController {

	/**
	 * Display a listing of summoners
	 *
	 * @return Response
	 */
	public function index()
	{
		$summoners = Summoner::all();

		return View::make('summoners.index', compact('summoners'));
	}

	/**
	 * Show the form for creating a new summoner
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('summoners.create');
	}

	/**
	 * Store a newly created summoner in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Summoner::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Summoner::create($data);

		return Redirect::route('summoners.index');
	}

	/**
	 * Display the specified summoner.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($region, $summoner_name)
	{
		//Input::get('summoner_name')
		$clean_summoner_name = str_replace(" ", "", $summoner_name);
		$clean_summoner_name = strtolower($clean_summoner_name);
		$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');
		
		$summoner = Summoner::where("region", "=", $region)->where("name", "=", $summoner_name)->first();
			if($summoner) {
				$summoner->refresh_summoner($region, $clean_summoner_name);
			}else{
				$summoner = new Summoner;
				$summoner->refresh_summoner($region, $clean_summoner_name);
			}
			return View::make('summoners.show', compact('summoner'));			
	}		
	

	/**
	 * Show the form for editing the specified summoner.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$summoner = Summoner::find($id);

		return View::make('summoners.edit', compact('summoner'));
	}

	/**
	 * Update the specified summoner in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$summoner = Summoner::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Summoner::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$summoner->update($data);

		return Redirect::route('summoners.index');
	}

	/**
	 * Remove the specified summoner from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Summoner::destroy($id);

		return Redirect::route('summoners.index');
	}

}
