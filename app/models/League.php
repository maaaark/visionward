<?php

class League extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
    
    
    protected $guarded = array('id');
	
	
	public function teams()
    {
        return $this->belongsToMany('Team');
    }
	
	public function matches()
    {
        return $this->hasMany('Match')->orderBy("game_date", "DESC")->where("parent_game", ">", "0");
    }
	
	public function placements()
    {
        return $this->hasMany('Placement');
    }

}