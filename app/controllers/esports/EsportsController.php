<?php

class EsportsController extends BaseController {
	public function index(){
		return View::make('esports.index');
	}
}