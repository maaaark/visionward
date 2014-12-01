<?php

class AdminArticlesController extends \BaseController {

	/**
	 * Display a listing of matches
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Article::orderBy("created_at", "DESC")->paginate(20);
		return View::make('admin.articles.index', compact('articles'));
	}

	/**
	 * Show the form for creating a new match
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::all();
		$galleries = Gallery::all();
		return View::make('admin.articles.create', compact('categories', 'galleries'));
	}

	/**
	 * Store a newly created match in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data["slug"] = Str::slug(Input::get('title'));
		$data["user_id"] = Auth::user()->id;
		Article::create($data);

		return Redirect::route('admin.articles.index')->with("success", "Erolgreich gespeichert");
	}

	/**
	 * Display the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$article = Article::findOrFail($id);
		return View::make('articles.show', compact('article'));
	}

	/**
	 * Show the form for editing the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$categories = Category::all();
		$article = Article::find($id);
        $galleries = Gallery::all();
		return View::make('admin.articles.edit', compact('article', 'galleries', 'categories'));
	}

	/**
	 * Update the specified match in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$article = Article::findOrFail($id);
        $data = Input::all();
		$data["slug"] = Str::slug(Input::get('title'));
		$article->update($data);
		return Redirect::route('admin.articles.index')->with("success", "Erolgreich gespeichert");
	}

	/**
	 * Remove the specified match from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Article::destroy($id);
		return Redirect::route('admin.articles.index');
	}

}
