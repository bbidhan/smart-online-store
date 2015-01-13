<?php

class Category extends Ardent {

	//RELATIONS
	public function products()
	{
		return $this->hasMany('Product');
	}	
	public function children()
	{
		return $this->hasMany('Category','parent_id');
	} 	
	public function parent()
	{
		return $this->belongsTo('Category','parent_id');
	}
	
}