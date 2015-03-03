<?php

class LeagueStanding extends \Eloquent {
	protected $fillable = [];
	protected $guarded = array('id');
	
	public function team()
    {
        return $this->belongsTo('Team');
    }
	
	public function league()
    {
        return $this->belongsTo('League');
    }
	
}