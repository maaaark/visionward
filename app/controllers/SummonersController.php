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
			$summoner->refresh_games();
			$summoner->refresh_summoner($region, $clean_summoner_name, $summoner->summoner_id, 0);
			$stats = $summoner->refresh_seasonchampstats($region, $summoner->summoner_id, 0);
			$stats = Seasonchampstat::where("summoner_id", "=", $summoner->summoner_id)->where("season", "=", 4)->orderBy('games', 'desc')->get();
			$rankedstats = Seasonrankedstat::where("summoner_id", "=", $summoner->summoner_id)->where("season", "=", 4)->first();
			$games = Game::where("summoner_id", "=", $summoner->summoner_id)->orderBy('createDate', 'desc')->take(10)->get();
			return View::make('summoners.show', compact('summoner', 'games', 'stats', 'rankedstats'));	
		}else{
			$searchString = $summoner_name;
			$news = $this->_generateNewsResult($summoner_name);
			$champs = $this->_generateChampResult($summoner_name);
			$players = $this->_generatePlayerResult($summoner_name);
			$teams = $this->_generateTeamResult($summoner_name);
			$summoner = "";
		
			$clean_summoner_name = str_replace(" ", "", $summoner_name);
			$clean_summoner_name = strtolower($clean_summoner_name);
			$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');
			
			$api_key = Config::get('api.key');
			
			$summoner_data = "https://".$region.".api.pvp.net/api/lol/".$region."/v1.4/summoner/by-name/".$clean_summoner_name."?api_key=".$api_key;
				$json = @file_get_contents($summoner_data);
				if($json === FALSE) {
					return Redirect::to("/")->with("error", "There was an error with the Riot API, please try again later! Code: 007");
				} else {
					$obj = json_decode($json, true);
					$summoner = Summoner::where("name","=",$obj[$clean_summoner_name]["name"])->where("region","=",$region)->first();
					if(!$summoner) {
						$summoner = new Summoner;
					}
					$summoner->summoner_id = $obj[$clean_summoner_name]["id"];
					$summoner->name = $obj[$clean_summoner_name]["name"];
					$summoner->profileIconId = $obj[$clean_summoner_name]["profileIconId"];
					$summoner->summonerLevel = $obj[$clean_summoner_name]["summonerLevel"];
					$summoner->revisionDate = $obj[$clean_summoner_name]["revisionDate"];
					$summoner->region = $region;
					$summoner->save();		
					$summoner = Summoner::where("name","=",$obj[$clean_summoner_name]["name"])->where("region","=",$region)->first();
				}
			return View::make('searches.show_result', compact('searchString', 'news', 'champs', 'players', 'teams', 'summoner'));
		}
	}		
	
	public function refresh_button($region, $summoner_name)
	{
		//Input::get('summoner_name')
		$clean_summoner_name = str_replace(" ", "", $summoner_name);
		$clean_summoner_name = strtolower($clean_summoner_name);
		$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');
		
		$summoner = Summoner::where("region", "=", $region)->where("name", "=", $summoner_name)->first();
			if($summoner) {
				$summoner->refresh_summoner($region, $clean_summoner_name, $summoner->summoner_id, 1);
				$stats = $summoner->refresh_seasonchampstats($region, $summoner->summoner_id, 1);
			}else{
				$summoner = new Summoner;
				$summoner->refresh_summoner($region, $clean_summoner_name, $summoner->summoner_id, 1);
				$summoner->refresh_seasonchampstats($region, $summoner->summoner_id, 1);
			}
			return Redirect::back();		
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
