<?php

class Match extends \Eloquent {
	
	protected $guarded = array('id');
	
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
	
	public function parent()
    {
        return $this->belongsTo('Match', 'parent_game');
    }
	
	public function children()
    {
        return $this->hasMany('Match', 'parent_game');
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
    
    public function team1topplayer()
    {
        return $this->belongsTo('Player', 'team1_top_player');
    }
    public function team2topplayer()
    {
        return $this->belongsTo('Player', 'team2_top_player');
    }
    public function team1jungleplayer()
    {
        return $this->belongsTo('Player', 'team1_jungle_player');
    }
    public function team2jungleplayer()
    {
        return $this->belongsTo('Player', 'team2_jungle_player');
    }
    public function team1midplayer()
    {
        return $this->belongsTo('Player', 'team1_mid_player');
    }
    public function team2midplayer()
    {
        return $this->belongsTo('Player', 'team2_mid_player');
    }
    public function team1adcplayer()
    {
        return $this->belongsTo('Player', 'team1_adc_player');
    }
    public function team2adcplayer()
    {
        return $this->belongsTo('Player', 'team2_adc_player');
    }
    public function team1supportplayer()
    {
        return $this->belongsTo('Player', 'team1_support_player');
    }
    public function team2supportplayer()
    {
        return $this->belongsTo('Player', 'team2_support_player');
    }
    
    
    public function team1topchampion()
    {
        return $this->belongsTo('Champion', 'team1_top_champion', 'champion_id');
    }
    public function team2topchampion()
    {
        return $this->belongsTo('Champion', 'team2_top_champion', 'champion_id');
    }
    public function team1midchampion()
    {
        return $this->belongsTo('Champion', 'team1_mid_champion', 'champion_id');
    }
    public function team2midchampion()
    {
        return $this->belongsTo('Champion', 'team2_mid_champion', 'champion_id');
    }
    public function team1junglechampion()
    {
        return $this->belongsTo('Champion', 'team1_jungle_champion', 'champion_id');
    }
    public function team2junglechampion()
    {
        return $this->belongsTo('Champion', 'team2_jungle_champion', 'champion_id');
    }
    public function team1adcchampion()
    {
        return $this->belongsTo('Champion', 'team1_adc_champion', 'champion_id');
    }
    public function team2adcchampion()
    {
        return $this->belongsTo('Champion', 'team2_adc_champion', 'champion_id');
    }
    public function team1supportchampion()
    {
        return $this->belongsTo('Champion', 'team1_support_champion', 'champion_id');
    }
    public function team2supportchampion()
    {
        return $this->belongsTo('Champion', 'team2_support_champion', 'champion_id');
    }
    
	
}