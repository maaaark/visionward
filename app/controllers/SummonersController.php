<?php

class SummonersController extends \BaseController {

	/**
	 * Display a listing of champions
	 *
	 * @return Response
	 */
	public function show()
	{
		$clean_summoner_name = str_replace(" ", "", Input::get('summoner_name'));
		$clean_summoner_name = strtolower($clean_summoner_name);
		$clean_summoner_name = mb_strtolower($clean_summoner_name, 'UTF-8');
		
		$api_key = Config::get('api.key');
		
		$summoner_data = "https://".Input::get('region').".api.pvp.net/api/lol/".Input::get('region')."/v1.4/summoner/by-name/".$clean_summoner_name."?api_key=".$api_key;
		$json = @file_get_contents($summoner_data);
		if($json === FALSE) {
			return Redirect::to('/')
			->withInput()
			->with('error', "API Fehler");
		} else {
			$summoner = json_decode($json, true);
			return View::make('summoners.show', compact('summoner'));	
		}
		
	}
	
	

}