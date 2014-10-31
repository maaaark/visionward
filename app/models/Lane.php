<?php

class Lane extends \Eloquent {
	protected $fillable = [];
	
	public function players()
    {
        return $this->hasMany('Player');
    }
	
}