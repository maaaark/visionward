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
        return $this->belongsTo('Champion');
    }

}