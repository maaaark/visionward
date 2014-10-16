<?php

class Picture extends \Eloquent {
	protected $fillable = array('filename', 'gallery_id');
	
    public static $rules = array(
       
    );
	
	public function gallery()
    {
        return $this->belongsTo('Gallery');
    }
	
}