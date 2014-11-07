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
		
		$api_key = Config::get('api.key');
		
		$summoner = Summoner::where("region", "=", $region)->where("name", "=", $clean_summoner_name)->first();
		
		if(!isset($summoner)) {
			$summoner_data = "https://".$region.".api.pvp.net/api/lol/".$region."/v1.4/summoner/by-name/".$clean_summoner_name."?api_key=".$api_key;
			$json = @file_get_contents($summoner_data);
			if($json === FALSE) {
				return $json;
				//return Redirect::to('/')->withInput()->with('error', "API Fehler");
			} else {
				$obj = json_decode($json, true);
				$summoner = Summoner::where("summoner_id","=",$obj[$clean_summoner_name]["id"])->where("region","=",Input::get('region'))->first();
				if(!$summoner) {
					$summoner = new Summoner;
					$summoner->summoner_id = $obj[$clean_summoner_name]["id"];
					$summoner->name = $obj[$clean_summoner_name]["name"];
					$summoner->profileIconId = $obj[$clean_summoner_name]["profileIconId"];
					$summoner->summonerLevel = $obj[$clean_summoner_name]["summonerLevel"];
					$summoner->revisionDate = $obj[$clean_summoner_name]["revisionDate"];
					$summoner->region = $region;
					$summoner->save();
				}
				
				$summoner->refresh_games();
				return View::make('summoners.show', compact('summoner'));			
			}
		} else {
			$summoner->refresh_games();
			return View::make('summoners.show', compact('summoner'));
		}	
		
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
