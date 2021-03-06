<?php

class Post extends \Eloquent {
	protected $fillable = array('title', 'content', 'corrected', 'published', 'slug', 'excerpt', 'user_id', 'gallery_id', 'schedule_time', 'schedule_check', 'image', 'show_autorbox', 'user_id', 'created_at');
	
	public static $rules = array(
		'title'=>'required|min:3',
		'excerpt'=>'required',
		'content'=>'required'
	);
	
	public static $update_rules = array(
		'title'=>'required|min:3',
		'excerpt'=>'required',
		'content'=>'required'
	);
	
	public function categories()
    {
        return $this->belongsToMany('Category');
    }

	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function gallery()
    {
        return $this->belongsTo('Gallery');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
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