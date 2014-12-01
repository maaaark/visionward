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
		$vips = Vip::orderBy('order', 'ASC')->get();
		return View::make('vips.index', compact('vips'));
	}

	public function show($id, $slug)
	{
		$vip = Vip::findOrFail($id);
		return View::make('vips.show', compact('vip'));
	}

	public function tooltip($id)
	{
		$vip = Vip::find($id);
		return Response::json(array('vip' => $vip));
	}

}