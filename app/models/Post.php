<?php

class Post extends \Eloquent {
	protected $fillable = [];
	
	public function categories()
    {
        return $this->belongsToMany('Category');
    }

	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function hasCategory($key)
    {
        foreach($this->categories as $category){
            if($category->slug === $key)
            {
                return true;
            }
        }
        return false;
    }
	
}