<?php

class AdminSlidersController extends \BaseController {
	
	public function index() {
		$sliders = Slider::orderBy("created_at", "DESC")->get();
		return View::make("admin.sliders.index", compact("sliders"));
	}
	
	public function edit($id) {
		$slider = Slider::find($id);
		return View::make("admin.sliders.edit", compact("slider"));
	}
	
	
	public function create() {
		return View::make("admin.sliders.create");
	}
	
	public function save() {
		$input = Input::all();
		$validation = Validator::make($input, Slider::$rules);
		$files = Input::file('images');
		
		if ($validation->passes())
		{	
			//var_dump($input['headline']);die("qwe");
		        $id = Str::random(14);
		        $destinationPath = public_path().'/uploads/sliders/'.$id;
		        $filename = $files->getClientOriginalName();
		        $mime_type = $files->getMimeType();
		        $extension = $files->getClientOriginalExtension();
		        $upload_success = $files->move($destinationPath, $filename);
				$url = $input['url'];
				$headline = $input['headline'];
				$subheadline = $input['subheadline'];
				
				//var_dump($link,$headline,$subheadline);die("qwe");
				
				$slider = new Slider;
				//$slider->gallery_id = Input::get('gallery_id');
				$slider->filename = $filename;
				$slider->extension = $extension;
				$slider->url = $url;
				$slider->headline = $headline;
				$slider->subheadline = $subheadline;
				$slider->destination = $id;
				//var_dump($slider);die("qwe");
				
				$slider->save();
			
	        //$slider = Slider::create($input);
			return Redirect::to('/admin/sliders')->with("success", "Bild/er hochgeladen");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/sliders/create")
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all());
		}
        
	}
	
	public function update() {
		$input = Input::all();
		//var_dump($input);die("qwe");
		$validation = Validator::make($input, Slider::$rules);
		if ($validation->passes())
		{
		//die("qwe");
			$slider = Slider::find(Input::get('id'));
			$slider->url = Input::get('url');
			$slider->headline = Input::get('headline');
			$slider->subheadline = Input::get('subheadline');
			//$slider->fill($input);
			
			if(Input::file('images')) {
			$oldImageFile = public_path().'/uploads/sliders/'.$slider->destination."/".$slider->filename;
			//var_dump($oldImageFile);die("qwe");
			$success = File::deleteDirectory(public_path().'/uploads/sliders/'.$slider->destination);
			//$deleteOldImage = File::delete(public_path().'/uploads/sliders/'.$slider->destination."/".$slider->filename);
			$file = Input::file('images');
			//var_dump($file);die("qwe");
			$id = Str::random(14);
			$filename = $file->getClientOriginalName();
			$destinationPath = public_path().'/uploads/sliders/'.$id;
	
			$mime_type = $file->getMimeType();
			$extension = $file->getClientOriginalExtension();
			//var_dump($slider->filename,$filename);die("qwe");
			$upload_success = $file->move($destinationPath, $filename);
			//var_dump($silder->filename,$silder->extension,$silder->destination,$filename,$extension,$id);die("qwe");
			$slider->filename = $filename;
			$slider->extension = $extension;
			$slider->destination = $id;
		}
			//var_dump($slider);die("qwe");
			$slider->save();
			
	        return Redirect::to('/admin/sliders/edit/'.Input::get('id'))->with("success", "Slider-Bild geupdated");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/sliders/edit/".Input::get('id'))
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all());
		}
        
	}
	
	public function destroy($id)
    {
        $slider = Slider::find($id);
		$success = File::deleteDirectory(public_path().'/uploads/sliders/'.$slider->destination);
		$slider->delete();
        return Redirect::to('/admin/sliders')->with("success", "Bild wurde gelöscht");
    }
	
}