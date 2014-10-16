<?php

class BaseController extends Controller {
	
	
    /*public function __construct()
	{
	   // Build our navigation
	   $settings = Cache::get('settings', function()
	   {
	       $settings = Setting::all();
	       Cache::forever('settings', $settings);
	       return $settings;
	   });

	   View::share('settings', $settings);
	}
	*/ 
	   
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}