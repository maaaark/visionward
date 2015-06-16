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

            if($validation->passes() && trim(Input::get("comment")) != "")
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
                    ->with('error', 'Der Kommentar wurde nicht erstellt.')->with('input', Input::all());
            }
        }
    }
    
    public function rateComment(){
      if(Auth::check() && Input::get("id") && Input::get("type")){
           $type    = Input::get("type");
           $comment = Comment::where("id", "=", Input::get("id"))->first();
           if(isset($comment["id"]) && $comment["id"] > 0){
              if($type == "up" || $type == "down"){
                  $rating = CommentRating::where("comment", "=", $comment["id"])->where("user", "=", Auth::user()->id)->first();
                  if(isset($rating) && isset($rating->id) && $rating->id > 0){
                     $rating->type = trim($type);
                  } else {
                     $rating          = new CommentRating();
                     $rating->type    = $type;
                     $rating->user    = Auth::user()->id;
                     $rating->comment = $comment["id"];
                  }
                  $rating->save();
              }
           }
        }
        
        if(isset($comment["id"]) && $comment["id"] > 0){
            echo Helpers::getCommentVotes($comment["id"]);
        } else {
            echo "0";
        }
    }

}