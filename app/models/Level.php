<?php

class Level extends \Eloquent {
	protected $fillable = [];
    protected $connection = 'mysql2';

    public function user() {
        return $this->belongsTo("User", "level", "level");
    }
}