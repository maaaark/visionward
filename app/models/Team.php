<?php

class Team extends \Eloquent {
	protected $fillable = [];
	
	public function players()
    {
        return $this->hasMany('Player');
    }
	
	public function leagues()
    {
        return $this->belongsToMany('League');
    }
	
}