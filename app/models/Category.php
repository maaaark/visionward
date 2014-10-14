<?php

class Category extends \Eloquent {
	protected $fillable = array('name', 'slug');
	
	public static $rules = array(
		'name'=>'required|min:3|unique:categories',
		'slug'=>'required|alpha|min:3|unique:categories'
	);
	
	public static $update_rules = array(
		'name'=>'required|min:3',
		'slug'=>'required|alpha|min:3'
	);
	
	public function posts()
    {
        return $this->belongsToMany('Post');
    }
}