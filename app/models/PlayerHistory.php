<?php

class PlayerHistory extends \Eloquent {
	protected $fillable = [];
	
	public function player()
    {
        return $this->belongsTo('Player');
    }
	
	public function old_team()
    {
        return $this->belongsTo('Team', 'old_team_id');
    }
	
}