<?php

class AdminCategoriesController extends \BaseController {
	
	public function index() {
		$categories = Category::all();
		return View::make("admin.categories.index", compact("categories"));
	}
	
	public function create() {
		return View::make("admin.categories.new");
	}
	
	public function edit($id) {
		$category = Category::find($id);
		return View::make("admin.categories.edit", compact("category"));
	}
	
	public function save() {
		$input = Input::all();
		$validation = Validator::make($input, Category::$rules);

		if ($validation->passes())
		{
	        Category::create($input);
	        return Redirect::to('/admin/categories')->with("success", "Kategorie angelegt");	
		} else {
			$messages = $validation->messages();
			return Redirect::to('/admin/categories/new')
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.');
		}
        
	}
	
	public function update() {
		$input = Input::all();

		$validation = Validator::make($input, Category::$update_rules);
		if ($validation->passes())
		{
			$categoery = Category::find(Input::get('category_id'));
			$categoery->fill($input);
			$categoery->save();
			
	        return Redirect::to('/admin/categories/edit/'.Input::get('category_id'))->with("success", "Kategorie geupdated");	
		} else {
			$messages = $validation->messages();
			return Redirect::to("/admin/categories/edit/".Input::get('category_id'))
			->withInput()
			->withErrors($validation)
			->with('error', 'There were validation errors.');
		}
        
	}
	
	public function destroy($id)
    {
        $category = Category::find($id);
		foreach($category->posts() as $news) {
			$news->category->detach($news->id);
		}
		$category->delete();
        return Redirect::to('/admin/categories')->with("success", "Kategorie wurde gelöscht und News geupdated");
    }
	
}