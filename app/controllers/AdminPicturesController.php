<?php

class AdminPicturesController extends \BaseController {
	
	public function index() {
		$pictures = Picture::orderBy("created_at", "DESC")->get();
		return View::make("admin.pictures.index", compact("pictures"));
	}
	
	public function edit($id) {
		$picture = Picture::find($id);
		$galleries = Gallery::all();
		return View::make("admin.pictures.edit", compact("picture", "galleries"));
	}
	
	
	public function create() {
		$galleries = Gallery::all();
		return View::make("admin.pictures.create", compact("galleries"));
	}
	
	public function save() {
		$input = Input::all();
		$validation = Validator::make($input, Picture::$rules);
		$files = Input::file('images');
		
		if ($validation->passes())
		{	
			foreach($files as $file) {
		        $id = Str::random(14);
		        $destinationPath = public_path().'/uploads/galleries/'.$id;
		        $filename = $file->getClientOriginalName();
		        $mime_type = $file->getMimeType();
		        $extension = $file->getClientOriginalExtension();
		        $upload_success = $file->move($destinationPath, $filename);
				
				$picture = new Picture;
				$picture->gallery_id = Input::get('gallery_id');
				$picture->filename = $filename;
				$picture->destination = $id;
				$picture->extension = $extension;
				$picture->save();
			}
			
	        //$picture = Picture::create($input);
			return Redirect::to('/admin/pictures')->with("success", "Bild/er hochgeladen");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/pictures/create")
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all());
		}
        
	}
	
	public function update() {
		$input = Input::all();
		$validation = Validator::make($input, Picture::$rules);
		if ($validation->passes())
		{
			$picture = Picture::find(Input::get('id'));
			$picture->fill($input);
			$picture->save();
			
	        return Redirect::to('/admin/pictures/edit/'.Input::get('id'))->with("success", "Bild geupdated");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/pictures/edit/".Input::get('id'))
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all());
		}
        
	}
	
	public function destroy($id)
    {
        $picture = Picture::find($id);
		$picture->delete();
        return Redirect::to('/admin/pictures')->with("success", "Bild wurde gelöscht");
    }
	
}