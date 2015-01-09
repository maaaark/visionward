<?php

class Counterpick extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	'g-recaptcha-response' => 'required|recaptcha',
	];

	// Don't forget to fill this array
	protected $guarded = array('id');
	
	public function champion()
    {
        return $this->belongsTo('Champion', 'counter_champion_id', 'champion_id');
    }
	
	public function counter()
    {
        return $this->belongsTo('Champion', 'champion_id', 'champion_id');
    }
	
	public function lane()
    {
        return $this->belongsTo('Lane');
    }
	


}
