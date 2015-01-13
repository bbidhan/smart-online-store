<?php

class Product extends Ardent {

	//RELATIONS
	public function vendor()
	{
		return $this->belongsTo('Vendor');
	}	
	public function category()
	{
		return $this->belongsTo('Category');
	}
	public function reviews()
	{
		return $this->hasMany('Review');
	}

	//Validation Rules
	public static $rules = array(
	    'name'                 => 'required|between:3,80',
	    //'description'          => 'min:10',
	    'price'                => 'required|numeric',
	    'discount'             => 'numeric',
	    'stock'                => 'required|numeric'
 	);


}