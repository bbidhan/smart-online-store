<?php

class Customer extends Ardent {

	//RELATIONS
	public function user()
    {
        return $this->morphOne('User', 'role');
    }
    public function orders()
	{
		return $this->hasMany('Order');
	}
	
	//Validation Rules
	public static $rules = array(
	    'firstname'             => 'required|alpha|between:3,16',
	    'lastname'              => 'required|alpha|between:3,16',
	    'phone'              	=> 'required|digits_between:9,13'
 	);
 	
	
}