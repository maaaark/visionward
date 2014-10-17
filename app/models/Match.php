<?php

class Match extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function team()
    {
        return $this->belongsTo('Team', 'team_id_1');
    }
	
	public function team2()
    {
        return $this->belongsTo('Team', 'team_id_2');
    }
	
	public function winner()
    {
        return $this->belongsTo('Team', 'winner_team_id');
    }
	
	public function league()
    {
        return $this->belongsTo('League');
    }
	
}