<?php

class Role extends \Eloquent {
	protected $fillable = [];
    protected $connection = 'mysql2';

	public function users()
    {
        return $this->belongsToMany('User');
    }
		
}