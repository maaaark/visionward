<?php

class VipsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /vips
	 *
	 * @return Response
	 */
	public function index()
	{
		$vips = Vip::all();
		return View::make('vips.index', compact('vips'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vips/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vips
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /vips/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $slug)
	{
		$vip = Vip::findOrFail($id);
		return View::make('vips.show', compact('vip'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vips/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vips/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vips/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}