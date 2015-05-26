<?php

class Gallery extends \Eloquent {
	protected $fillable = array('title', 'description', 'slug');
	
	public static $rules = array(
		'title'=>'required|min:3',
		'slug'=>'required|min:3|unique:galleries'
	);
	
	public function pictures()
    {
        return $this->hasMany('Picture');
    }
	
	public function posts()
    {
        return $this->hasMany('Post');
    }
	
	public function articles()
    {
        return $this->hasMany('Article');
    }
}