<?php

class Item extends \Eloquent {


	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
	public function game()
    {
		return $this->belongsTo('Game');
    }

}