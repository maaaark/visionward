<?php

class Player extends \Eloquent {
	protected $guarded = array('id');
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];
	protected $fillable = [];
	
	public function team()
    {
        return $this->belongsTo('Team');
    }
	
	public function last_team()
    {
        return $this->belongsTo('Team');
    }
	
	public function history()
    {
        return $this->hasMany('PlayerHistory');
    }
	
}