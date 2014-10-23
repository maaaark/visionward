<?php

class Team extends \Eloquent {
	protected $fillable = [];
	protected $guarded = array('id');
	public static $rules = [
		// 'title' => 'required'
	];
	
	public function players()
    {
        return $this->hasMany('Player');
    }
	
	public function leagues()
    {
        return $this->belongsToMany('League');
    }
	
	public function hasLeague($slug)
    {
        foreach($this->leagues as $league){
            if($league->slug === $slug)
            {
                return true;
            }
        }
        return false;
    }
	
	public function getRole($role) {
		$player = Player::where("team_id", "=", $this->id)->where("role", "=", $role)->first();
		if($player) {
			return $player;
		}
	}
	
}