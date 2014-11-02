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
		//var_dump($input);die("qwe");
		$news = $this->_generateNewsResult($input['search']);
		$champs = $this->_generateChampResult($input['search']);
		$players = $this->_generatePlayerResult($input['search']);
		$teams = $this->_generateTeamResult($input['search']);
		return View::make('searches.show_result', compact('news', 'champs', 'players', 'teams'));
	}
	
	protected function _generateNewsResult($searchString)
	{
		//var_dump($searchString);
		$searches = DB::table('posts')
			->where('title', 'LIKE', '%'.$searchString.'%')
			->orWhere('content', 'LIKE', '%'.$searchString.'%')
			->get();
			
		//$countResult = count($results);
		//foreach($results as $result) {
		//	var_dump($result->title);
		//}
		//var_dump($countResult);die("qwe");
		return $searches;
	}
	
	protected function _generateChampResult($searchString)
	{
		$searches = DB::table('champions')
			->where('name', 'LIKE', '%'.$searchString.'%')
			->orWhere('key', 'LIKE', '%'.$searchString.'%')
			->orWhere('title', 'LIKE', '%'.$searchString.'%')
			->get();
		return $searches;
	}
	
	protected function _generatePlayerResult($searchString)
	{
		$searches = DB::table('players')
			->where('nickname', 'LIKE', '%'.$searchString.'%')
			->orWhere('first_name', 'LIKE', '%'.$searchString.'%')
			->orWhere('last_name', 'LIKE', '%'.$searchString.'%')
			->get();
		return $searches;
	}
	
	protected function _generateTeamResult($searchString)
	{
		$searches = DB::table('teams')
			->where('name', 'LIKE', '%'.$searchString.'%')
			->get();
		return $searches;
	}

}
