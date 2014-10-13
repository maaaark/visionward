<?php

class Champion extends \Eloquent {

	
	public function skins()
    {
        return $this->hasMany('Skin');
    }
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}