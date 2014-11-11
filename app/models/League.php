<?php

class League extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
    
    
    protected $guarded = array('id');
	
	
	public function teams()
    {
        return $this->belongsToMany('Team');
    }

}