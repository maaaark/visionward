<?php

class AdminSettingsController extends \BaseController {
	
	public function index() {
		$settings = Setting::orderBy("id", "ASC")->get();
		return View::make("admin.settings.index", compact("settings"));
	}
	
	public function edit($id) {
		$settings = Setting::find($id);
		//var_dump($settings);die("qwe");
		return View::make("admin.settings.edit", compact("settings"));
	}
	
	public function update() {
		$input = Input::all();
		
		$validation = Validator::make($input, Setting::$rules);
		if ($validation->passes())
		{
			$setting = Setting::find(Input::get('id'));

			$setting->fill($input);
			$setting->save();
			
	        return Redirect::to('/admin/settings')->with("success", "Setting updated");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/settings/edit/".Input::get('id'))
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all())->with('roles', $roles);
		}
        
	}
	
}