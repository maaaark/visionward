<?php

class Skin extends \Eloquent {
	
	
	public function team()
    {
        return $this->belongsTo('Champion');
    }
	
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
}