<?php

class Article extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $guarded = ['id'];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function gallery()
    {
        return $this->belongsTo('Gallery');
    }

}