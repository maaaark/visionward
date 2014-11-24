<?php

class Seasonchampstat extends \Eloquent {
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	public function champion()
    {
        return $this->belongsTo('Champion', 'champion_id', 'champion_id');
    }
	
	public function summoner()
    {
        return $this->belongsTo('Summoner', 'summoner_id','summoner_id');
    }
}