<?php

class AdminFeaturedContentsController extends \BaseController {
	
	public function index() {
		$featuredContents = FeaturedContent::orderBy("created_at", "DESC")->get();
		return View::make("admin.featuredContents.index", compact("featuredContents"));
	}
	
	public function edit($id) {
		$featuredContents = FeaturedContent::find($id);
		//var_dump($featuredContents, $id);die("qwe");
		return View::make("admin.featuredContents.edit", compact("featuredContents"));
	}
	
	
	public function create() {
		return View::make("admin.featuredContents.create");
	}
	
	public function save() {
		$input = Input::all();
		$validation = Validator::make($input, FeaturedContent::$rules);
		$files = Input::file('images');
		
		if ($validation->passes())
		{	
			//var_dump($input['headline']);die("qwe");
		        $id = Str::random(14);
		        $destinationPath = public_path().'/uploads/featuredcontent/'.$id;
		        $filename = $files->getClientOriginalName();
		        $mime_type = $files->getMimeType();
		        $extension = $files->getClientOriginalExtension();
		        $upload_success = $files->move($destinationPath, $filename);
				$url = $input['url'];
				$headline = $input['headline'];
				$published = $input['published'];
				$order = $input['order'];
				
				//var_dump($link,$headline,$subheadline);die("qwe");
				
				$featuredContents = new FeaturedContent;
				//$featuredContents->gallery_id = Input::get('gallery_id');
				$featuredContents->filename = $filename;
				$featuredContents->extension = $extension;
				$featuredContents->url = $url;
				$featuredContents->headline = $headline;
				$featuredContents->destination = $id;
				$featuredContents->published = $published;
				$featuredContents->order = $order;
				//var_dump($featuredContents);die("qwe");
				
				$featuredContents->save();
			
	        //$featuredContents = FeaturedContent::create($input);
			return Redirect::to('/admin/featuredContents')->with("success", "Bild/er hochgeladen");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/featuredContents/create")
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all());
		}
        
	}
	
	public function update() {
		$input = Input::all();
		//var_dump($input);die("qwe");
		$validation = Validator::make($input, FeaturedContent::$rules);
		if ($validation->passes())
		{
		//die("qwe");
			$featuredContents = FeaturedContent::find(Input::get('id'));
			$featuredContents->url = Input::get('url');
			$featuredContents->headline = Input::get('headline');
			$featuredContents->published = Input::get('published');
			$featuredContents->order = Input::get('order');
			//$featuredContents->fill($input);
			
			if(Input::file('images')) {
			$oldImageFile = public_path().'/uploads/featuredcontent/'.$featuredContents->destination."/".$featuredContents->filename;
			//var_dump($oldImageFile);die("qwe");
			$success = File::deleteDirectory(public_path().'/uploads/featuredcontent/'.$featuredContents->destination);
			//$deleteOldImage = File::delete(public_path().'/uploads/featuredcontent/'.$featuredContents->destination."/".$featuredContents->filename);
			$file = Input::file('images');
			//var_dump($file);die("qwe");
			$id = Str::random(14);
			$filename = $file->getClientOriginalName();
			$destinationPath = public_path().'/uploads/featuredcontent/'.$id;
	
			$mime_type = $file->getMimeType();
			$extension = $file->getClientOriginalExtension();
			//var_dump($featuredContents->filename,$filename);die("qwe");
			$upload_success = $file->move($destinationPath, $filename);
			//var_dump($silder->filename,$silder->extension,$silder->destination,$filename,$extension,$id);die("qwe");
			$featuredContents->filename = $filename;
			$featuredContents->extension = $extension;
			$featuredContents->destination = $id;
		}
			//var_dump($featuredContents);die("qwe");
			$featuredContents->save();
			
	        return Redirect::to('/admin/featuredContents/edit/'.Input::get('id'))->with("success", "FeaturedContent-Bild geupdated");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/featuredContents/edit/".Input::get('id'))
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.')->with('input', Input::all());
		}
        
	}
	
	public function destroy($id)
    {
        $featuredContents = FeaturedContent::find($id);
		$success = File::deleteDirectory(public_path().'/uploads/featuredContents/'.$featuredContents->destination);
		$featuredContents->delete();
        return Redirect::to('/admin/featuredContents')->with("success", "Bild wurde gelöscht");
    }
	
}