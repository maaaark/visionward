<?php

class Comment extends \Eloquent {
	protected $fillable = [];
    protected $guarded = array('id');
    public static $rules = array();

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}