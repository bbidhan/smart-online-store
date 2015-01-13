<?php

class Order extends Ardent {

	//RELATIONS
	public function customer()
	{
		return $this->belongsTo('Customer');
	}
	//Validation Rules
	public static $rules = array(
	    'items'                 => 'required|between:1,200',
	    'price'                => 'required|numeric'
 	);


}