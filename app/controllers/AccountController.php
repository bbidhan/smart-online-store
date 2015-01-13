<?php

class AccountController extends BaseController {

	public function signup()
	{
		return View::make('signup');
	}

	public function signin()
	{
		return View::make('signin');
	}

	public function signout()
	{
		if (Auth::check())
			Auth::logout();            
		return Redirect::action('HomeController@index')->withMessage('You have successfully signed out!');
	}
	
	public function myaccount()
	{
		return View::make('myaccount');
	}

	public function store_user()
	{
		$user = new User;
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->password = Input::get('password');
		$user->password_confirmation = Input::get('password_confirmation');

		$customer = new Customer;
		$customer->firstname = Input::get('firstname');
		$customer->lastname = Input::get('lastname');
		$customer->phone = Input::get('phone');

		$customer->validateUniques();
		$user->validateUniques();
		if ($user->validateUniques() && $customer->validateUniques()) {
			$customer->recommended_products = "533,549,558,336,294,978,330,16,244,290";
			$customer->save();
			$user->role_id = $customer->id;
			$user->role_type = 'Customer';
			$user->save();
            return Redirect::action('HomeController@index')->with('message', 'You have successfully created an account!');
        } else {
            //return Redirect::action('AccountController@signup')->withErrors($user->errors());
            return Redirect::action('AccountController@signup')->withErrors(array_merge_recursive($user->errors()->toArray(), $customer->errors()->toArray()));
        }
	}	
	public function authenticate()
	{
		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')),Input::get('remember')==true))
		{
		     return Redirect::action('HomeController@index')->with('message', 'You have successfully signed in!');
		} else {
			return Redirect::action('AccountController@signin')
									->with('message', 'Incorrect e-mail and/or password!')
									->withInput(Input::flashOnly('email'));
		}
	}

}