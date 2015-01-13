<?php

class Vendor extends Ardent {

	//RELATIONS
	public function user()
    {
        return $this->morphOne('User', 'role');
    }
	public function products()
	{
		return $this->hasMany('Product');
	}


	//Validation Rules
	public static $rules = array(
	    'name'         => 'required|between:3,40',
	    'description'  => 'required|between:3,40',
	    'address'  	   => 'required|between:3,40',
	    'discount'     => 'integer',
	    'phone'        => 'required|digits_between:9,13'
 	);
 	
	
}