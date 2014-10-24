<?php

class Skill extends \Eloquent {

	public function champion()
    {
        return $this->belongsTo('Champion', 'champion_id', 'champion_id');
    }
	
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
}