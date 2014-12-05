<?php

class HomeController extends BaseController {

	public function showWelcome()
	{
		$posts = Post::all();
		return View::make('hello', compact('posts'));
	}
	
	public function team()
	{
		$users = User::orderBy("order", "ASC")->get();
		return View::make('pages.team', compact('users'));
	}
	
	public function impressum()
	{
		return View::make('pages.legal');
	}
	public function spells()
	{
		$api_key = Config::get('api.key');
		$spells = include("spells.json");
		$obj = json_decode($spells, true);
		foreach($obj["data"] as $champion) {
			echo $champion["name"]."<br/>";
		}
		//return View::make('pages.spells', compact('champions'));
	}
	
	public function datenschutz()
	{
		return View::make('pages.datenschutz');
	}
	
	public function feedback()
	{
		$data = Input::all();
		$id = uniqid();
		$feedback = new Feedback;
		$feedback->note = $data["note"];
		$feedback->url = $data["url"];
		$feedback->img = $id;
		
		$img = $data["img"];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data2 = base64_decode($img);
			
		$file = public_path()."/img/feedback/".$id.".png";
		$success = file_put_contents($file, $data2);
		$feedback->save();
		
		return $data;
	}
	
	

}