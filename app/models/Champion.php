<?php

class Champion extends \Eloquent {
	
	protected $guarded = array('id', 'champion_id');
	
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