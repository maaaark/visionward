<?php

class Category extends \Eloquent {
	protected $fillable = array('name', 'slug');
	
	public function posts()
    {
        return $this->belongsToMany('Post');
    }
}