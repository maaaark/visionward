<?php

class PostController extends BaseController {

	public function index()
	{
		$posts = Post::orderBy('created_at', 'DESC')->where("published", "=", 1)->paginate(13);
		$slider = Slider::where("published", "=", 1)->orderBy("order", "ASC")->get();
		
		return View::make('posts.index', compact('posts', 'slider'));
	}
	
	public function show($id, $slug)
	{
		$post = Post::findOrFail($id);
		return View::make('posts.show', compact('post'));
	}
	
	public function archive()
	{
		$posts = Post::orderBy('created_at', 'DESC')->where("published", "=", 1)->skip(13)->paginate(25);
		$slider = Slider::where("published", "=", 1)->orderBy("order", "ASC")->get();
		
		return View::make('posts.archive', compact('posts', 'slider'));
	}

    public function saveComment() {
        if(Auth::check()) {
            $input = Input::all();
            $post_id = Input::get('post_id');
            $news = Post::find($post_id);
            $validation = Validator::make($input, Comment::$rules);

            if ($validation->passes())
            {
                $input["user_id"] = Auth::user()->id;
                Comment::create($input);
                Auth::user()->addExp(50);
                return Redirect::to('/news/'.$post_id."/".$news->slug)->with("success", "Kommentar wurde erstellt");
            } else {
                $messages = $validation->messages();
                return Redirect::to("/news/".$post_id."/".$news->slug)
                    ->withInput()
                    ->withErrors($validation)
                    ->with('error', 'There were validation errors.')->with('input', Input::all());
            }
        }
    }

}