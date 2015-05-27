<?php

class AdminGalleriesController extends \BaseController {
	
	public function index() {
		$galleries = Gallery::orderBy("created_at", "DESC")->get();
		return View::make("admin.galleries.index", compact("galleries"));
	}
	
	public function edit($id) {
		$gallery = Gallery::find($id);
		return View::make("admin.galleries.edit", compact("gallery"));
	}
	
	
	public function create() {
		return View::make("admin.galleries.create");
	}
	
	public function save() {
		$input = Input::all();
		$input["slug"] = Str::slug(Input::get('title'));
		$validation = Validator::make($input, Gallery::$rules);
		
		if ($validation->passes())
		{	
	        $gallery = Gallery::create($input);
			return Redirect::to('/admin/galleries')->with("success", "Galerie erstellt");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/galleries/create")
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all());
		}
        
	}
	
	public function update() {
		$input = Input::all();
		$input["slug"] = Str::slug(Input::get('title'));
		
		$validation = Validator::make($input, Gallery::$rules);
		if ($validation->passes())
		{
			$gallery = Gallery::find(Input::get('id'));
			$gallery->fill($input);
			$gallery->save();
			
	        return Redirect::to('/admin/galleries/edit/'.Input::get('id'))->with("success", "Galerie geupdated");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/galleries/edit/".Input::get('id'))
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all());
		}
        
	}
	
	public function destroy($id)
    {
        $gallery = Gallery::find($id);
		foreach($gallery->pictures() as $picture) {
			$picture->gallery_id = 0;
			$picture->save();
		}
		$gallery->delete();
        return Redirect::to('/admin/galleries')->with("success", "Galerie wurde gelöscht");
    }
	
}