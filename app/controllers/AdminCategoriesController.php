<?php

class AdminCategoriesController extends \BaseController {
	
	public function index() {
		$categories = Category::all();
		return View::make("admin.categories.index", compact("categories"));
	}
	
	public function create() {
		return View::make("admin.categories.new");
	}
	
	public function save() {
		$input = Input::all();
        Category::create($input);
        return Redirect::to('/admin/categories')->with("success", "Kategorie angelegt");
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