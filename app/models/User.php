<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Ardent implements UserInterface, RemindableInterface {

	//RELATIONS
	public function role()
    {
        return $this->morphTo();
    }
    public function reviews()
	{
		return $this->hasMany('Review');
	}
	
	//Validation Rules
	public static $rules = array(
	    'email'                 => 'required|email|unique:users',
	    'username'              => 'alpha_dash|between:4,16|unique:users',
	    'password'              => 'required|between:6,16|confirmed'
 	);
	public $autoPurgeRedundantAttributes = true;	//Dont save password_confirmation field
	public static $passwordAttributes  = array('password');
  	public $autoHashPasswordAttributes = true;

	protected $hidden = array('password');


	public function is_admin(){
		if ($this->role_type == 'Admin'){
			return true;
		}
		return false;
	}
	public function is_vendor(){
		if ($this->role_type == 'Vendor'){
			return true;
		}
		return false;
	}
	public function is_customer(){
		if ($this->role_type == 'Customer'){
			return true;
		}
		return false;
	}
	

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}