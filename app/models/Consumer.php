<?php

class Consumer extends Ardent {

	//RELATIONS
	public function user()
    {
        return $this->morphOne('User', 'role');
    }
		
	
}