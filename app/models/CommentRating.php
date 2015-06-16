<?php

class CommentRating extends \Eloquent {
	protected $table = 'comments_ratings';
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];
	
}