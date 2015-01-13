<?php

class Review extends Ardent {

	//RELATIONS
	public function product()
	{
		return $this->belongsTo('Product');
	}	
	public function user()
	{
		return $this->belongsTo('User');
	}

	//Validation Rules
	public static $rules = array(
	    'title'                 => 'required|between:3,80',
	    //'description'          => 'min:10',
	    'rating'                => 'required|numeric'
 	);


}