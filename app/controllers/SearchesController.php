<?php

class SearchesController extends \BaseController {

	/**
	 * Display a listing of searches
	 *
	 * @return Response
	 */
	public function index()
	{
		$searches = Search::all();

		return View::make('searches.index', compact('searches'));
	}

	/**
	 * Show the form for creating a new search
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('searches.create');
	}

	/**
	 * Store a newly created search in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Search::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Search::create($data);

		return Redirect::route('searches.index');
	}

	/**
	 * Display the specified search.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$search = Search::findOrFail($id);

		return View::make('searches.show', compact('search'));
	}

	/**
	 * Show the form for editing the specified search.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$search = Search::find($id);

		return View::make('searches.edit', compact('search'));
	}

	/**
	 * Update the specified search in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$search = Search::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Search::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$search->update($data);

		return Redirect::route('searches.index');
	}

	/**
	 * Remove the specified search from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Search::destroy($id);

		return Redirect::route('searches.index');
	}
	
	
	public function show_result()
	{
		$input = Input::all();
		$summoner = "";
		if($input['server_region'] != "none") {
			
			$clean_summoner_name = str_replace(" ", "", $input['search']);
			$clean_summoner_name = strtolower($clean_summoner_name);
			$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');
			
			$api_key = Config::get('api.key');
			
			$summoner_data = "https://".$input['server_region'].".api.pvp.net/api/lol/".$input['server_region']."/v1.4/summoner/by-name/".$clean_summoner_name."?api_key=".$api_key;
			$json = @file_get_contents($summoner_data);
			if($json === FALSE) {
				//return Redirect::to("/")->with("error", "There was an error with the Riot API, please try again later! Code: 006");
			} else {
				$obj = json_decode($json, true);
				$summoner = Summoner::where("name","=",$obj[$clean_summoner_name]["name"])->where("region","=",$input['server_region'])->first();
				$summonertimecheck = Summoner::where("name","=",$obj[$clean_summoner_name]["name"])->where("region","=",$input['server_region'])->where('updated_at', '<', \Carbon\Carbon::now()->subSeconds(300))->first();
				if(!$summoner or $summonertimecheck){
					if(!$summoner) {
						$summoner = new Summoner;
					}
					$summoner->summoner_id = $obj[$clean_summoner_name]["id"];
					$summoner->name = $obj[$clean_summoner_name]["name"];
					$summoner->profileIconId = $obj[$clean_summoner_name]["profileIconId"];
					$summoner->summonerLevel = $obj[$clean_summoner_name]["summonerLevel"];
					$summoner->revisionDate = $obj[$clean_summoner_name]["revisionDate"];
					$summoner->region = $input['server_region'];
					$summoner_stats = "https://".$input['server_region'].".api.pvp.net/api/lol/".$input['server_region']."/v1.3/stats/by-summoner/".$summoner->summoner_id."/summary?season=SEASON4&api_key=".$api_key;
					$json2 = @file_get_contents($summoner_stats);
					if($json2 === FALSE) {
						//return Redirect::to("/")->with("error", "There was an error with the Riot API, please try again later! Code: 010");
					} else {
						$obj2 = json_decode($json2, true);
						if(isset($obj2["playerStatSummaries"])){
							foreach($obj2["playerStatSummaries"] as $gamemode){
								if($gamemode["playerStatSummaryType"] == 'RankedSolo5x5'){
									$summoner->ranked_wins = $gamemode['wins'];
									$summoner->ranked_losses = $gamemode['losses'];
								}
								if($gamemode["playerStatSummaryType"] == 'Unranked'){
									$summoner->unranked_wins = $gamemode['wins'];
								}
								if($gamemode["playerStatSummaryType"] == 'RankedTeam5x5'){
									$summoner->teamranked_wins = $gamemode['wins'];
									$summoner->teamranked_losses = $gamemode['losses'];
								}
							}
						}
					$summoner->save();
					$summoner = Summoner::where("name","=",$obj[$clean_summoner_name]["name"])->where("region","=",$input['server_region'])->first();
					}
				}
			}
		}
		//var_dump($input['search']);die("qwe");
		$searchString = $input['search'];
		$news = $this->_generateNewsResult($input['search']);
		$champs = $this->_generateChampResult($input['search']);
		$players = $this->_generatePlayerResult($input['search']);
		$teams = $this->_generateTeamResult($input['search']);

		return View::make('searches.show_result', compact('searchString', 'news', 'champs', 'players', 'teams', 'summoner'));
	}
	


}
