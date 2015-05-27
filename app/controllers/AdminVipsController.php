<?php

class AdminVipsController extends \BaseController {

	/**
	 * Display a listing of matches
	 *
	 * @return Response
	 */
	public function index()
	{
		$vips = Vip::orderBy("nickname","DESC")->get();
		return View::make('admin.vips.index', compact('vips'));
	}

	public function create()
	{
		return View::make('admin.vips.create');
	}

	/**
	 * Store a newly created match in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data["slug"] = Str::slug(Input::get("nickname"));
		Vip::create($data);

		return Redirect::route('admin.vips.index')->with("success", "Erolgreich gespeichert");
	}
	
	/**
	 * Show the form for editing the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vip = Vip::find($id);
        
		return View::make('admin.vips.edit', compact('vip'));
	}

	/**
	 * Update the specified match in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$vip = Vip::findOrFail($id);
        $data = Input::all();
		$data["slug"] = Str::slug(Input::get("nickname"));
		$vip->update($data);

		return Redirect::route('admin.vips.index')->with("success", "Erolgreich gespeichert");
	}

}
