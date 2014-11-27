<?php

class AdminSkinsController extends \BaseController {

	/**
	 * Display a listing of matches
	 *
	 * @return Response
	 */
	public function index()
	{
		$skins = Skin::orderBy("sale","DESC")->get();
		return View::make('admin.skins.index', compact('skins'));
	}

	/**
	 * Show the form for editing the specified match.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$skin = Skin::find($id);
        
		return View::make('admin.skins.edit', compact('skin'));
	}

	/**
	 * Update the specified match in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$skin = Skin::findOrFail($id);
        $data = Input::all();
		$skin->update($data);

		return Redirect::route('admin.skins.index')->with("success", "Erolgreich gespeichert");
	}

}
