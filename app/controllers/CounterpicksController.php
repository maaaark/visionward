<?php

class CounterpicksController extends \BaseController {

	/**
	 * Display a listing of counterpicks
	 *
	 * @return Response
	 */
	public function index()
	{
		$counterpicks = Counterpick::orderBy("votes", "DESC")->groupBy("champion_id")->get();
		
		return View::make('counterpicks.index', compact('counterpicks'));
	}

	/**
	 * Show the form for creating a new counterpick
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$champions = Champion::orderBy('name', 'ASC')->get();
		$champ = Champion::find($id);
		if($champ){
		return View::make('counterpicks.create',  compact('champions', 'champ'));
		}else{
			return Redirect::to("/counterpicks")->with('error', 'Unbekannter Champion');	
		}
	}

	/**
	 * Store a newly created counterpick in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Counterpick::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Counterpick::create($data);

		return Redirect::route('counterpicks.index');
	}

	/**
	 * Display the specified counterpick.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $key)
	{
		$champion = Champion::where("champion_id", "=", $id)->first();
		
		$good = Counterpick::where("type", "=", "good")->where("champion_id", "=", $id)->orderBy("upvotes", "desc")->get();
		$bad = Counterpick::where("type", "=", "bad")->where("champion_id", "=", $id)->orderBy("upvotes", "desc")->get();
		
		return View::make('counterpicks.show', compact('champion', 'good', 'bad'));
	}
	
	public function details($id, $key, $counter_champion_id, $counter_champion_key)
	{
		$champion = Champion::where("champion_id", "=", $id)->first();
		$counter = Champion::where("champion_id", "=", $counter_champion_id)->first();
		
		$counterpick = Counterpick::where("champion_id", "=", $id)->where("counter_champion_id", "=", $counter_champion_id)->first();
		
		return View::make('counterpicks.details', compact('champion', 'counter', 'counterpick'));
	}

	/**
	 * Show the form for editing the specified counterpick.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$counterpick = Counterpick::find($id);

		return View::make('counterpicks.edit', compact('counterpick'));
	}

	/**
	 * Update the specified counterpick in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$counterpick = Counterpick::findOrFail($id);
		$validator = Validator::make($data = Input::all(), Counterpick::$rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$counterpick->update($data);
		return Redirect::route('counterpicks.index');
	}

	/**
	 * Remove the specified counterpick from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Counterpick::destroy($id);

		return Redirect::route('counterpicks.index');
	}

	public function championdownvotes($id)
    {
		$cookie = false;
		$cookie2 = false;
		if(Cookie::get('Visionward_countervotes'.$id.'down')){}else{
        $counter = Counterpick::where('id', '=', $id)->first();
			$counter->downvotes +=1;
			$counter->votes -= 1;
			$cookie = Cookie::forever('Visionward_countervotes'.$id.'down', $id);
			if(Cookie::get('Visionward_countervotes'.$id.'up')){
				$cookie2 = Cookie::forget('Visionward_countervotes'.$id.'up');
				$counter->upvotes -= 1;
			}
			$counter->save();
		}
		if($cookie && $cookie2){
			return Redirect::back()->withCookie($cookie)->withCookie($cookie2);
		}elseif($cookie){
			return Redirect::back()->withCookie($cookie);
		}else{
			return Redirect::back()->with('error', 'Du hast bereits für diesen Konter gevotet');
		}
    }
	
	public function championupvotes($id)
    {
		$cookie = false;
		$cookie2 = false;
		if(Cookie::get('Visionward_countervotes'.$id.'up')){}else{
        $counter = Counterpick::where('id', '=', $id)->first();
			$counter->upvotes += 1;
			$counter->votes += 1;
			$cookie = Cookie::forever('Visionward_countervotes'.$id.'up', $id);
			if(Cookie::get('Visionward_countervotes'.$id.'down')){
				$cookie2 = Cookie::forget('Visionward_countervotes'.$id.'down');
				$counter->downvotes -=1;
			}
			$counter->save();
		}
		if($cookie && $cookie2){
			return Redirect::back()->withCookie($cookie)->withCookie($cookie2);
		}elseif($cookie){
			return Redirect::back()->withCookie($cookie);
		}else{
			return Redirect::back()->with('error', 'Du hast bereits für diesen Konter gevotet');
		}
    }

	public function create_counter()
    {
		$champ = Champion::where('champion_id', '=', Input::get('champ'))->first();
		$counter = Champion::where('champion_id', '=', Input::get('choose_counter'))->first();
		$type = Input::get('choose_type');
		if($type == 'Gut gegen'){
			$type = 'good';
		}elseif($type == 'Schlecht gegen'){
			$type = 'bad';
		}
		if($champ && $counter && $type == 'bad' or $type == 'good'){
			$check_counter = Counterpick::where('champion_id', '=', Input::get('champ'))->where('counter_champion_id', '=', Input::get('choose_counter'))->where('type','=', $type)->first(); 
		
		if(!$check_counter){
			$new_counter = new Counterpick;
			$new_counter->champion_id = Input::get('champ');
			$new_counter->description = Input::get('description');
			$new_counter->counter_champion_id = Input::get('choose_counter');
			$new_counter->lane = Input::get('lane');
			$new_counter->type = $type;
			$new_counter->save();
			return Redirect::to("/counterpicks/".Input::get('champ').'/'.$champ->key)->with('success', 'Konter angelegt');	
		}else{
			return Redirect::to("/counterpicks/".Input::get('champ').'/'.$champ->key)->with('error', 'dieser Konter ist bereits angelegt');
		}
		}
		return Redirect::to("/counterpicks/".Input::get('champ').'/'.$champ->key)->with('error', 'Fehler in den Daten');	
    }
	
}
