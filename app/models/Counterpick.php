<?php

class Counterpick extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	public function champion()
    {
        return $this->belongsTo('Champion', 'counter_champion_id', 'champion_id');
    }
	
	public function counter()
    {
        return $this->belongsTo('Champion', 'champion_id', 'champion_id');
    }
	
	

	public function championvotes($id, $vote)
    {
        $counter = DB::table('counterpicks')->where('id', '=', $id)->get();
		if($vote == 'up'){
			$counter->upvotes += 1;
			$counter->votes += 1;
		}elseif($vote == 'down'){
			$counter->downvotes +=1;
			$counter->votes -= 1;
		}
		$counter->save();
		
		$cookie = Cookie::make('visionward vote 24Std', 'bla', 3600);
		$cockie->save();
    }
}