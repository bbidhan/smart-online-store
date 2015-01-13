<?php

class VendorController extends BaseController {

	//Display a listing of the resource.
	public function index()
	{
		$vendors = Vendor::all();
		$vendors = Vendor::paginate(10);
		return View::make('admin.vendor')->with('vendors',$vendors)->withMenu('5');
	}

	//Show the form for creating a new resource.
	public function create()
	{
		return View::make('admin.create_vendor');
	}

	//Store a newly created resource in storage.
	public function store()
	{
		$user = new User;
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->password = Input::get('password');
		$user->password_confirmation = Input::get('password_confirmation');

		$vendor = new vendor;
		$vendor->name = Input::get('name');
		$vendor->description = Input::get('description');
		$vendor->address = Input::get('address');
		$vendor->phone = Input::get('phone');
		$vendor->location_id = 0;
		
		$vendor->validateUniques();
		if ($user->validateUniques() && $vendor->validateUniques()) {
			$vendor->save();
			$user->role_id = $vendor->id;
			$user->role_type = 'vendor';
			$user->save();
           return Redirect::action('VendorController@index')->with('message', 'A new vendor was added!');
		 }
         else {
            return Redirect::action('VendorController@create')->withErrors(array_merge_recursive($user->errors()->toArray(), $vendor->errors()->toArray()));
        }
		}
	

	//Display the specified resource.
	public function show($id)
	{
	    $vendor = Vendor::find($id);
		
		 echo $vendor->description ;
		}

	//Show the form for editing the specified resource.
	public function edit($id)
	{
		$vendor = Vendor::find($id);
		return View::make('admin.edit_vendor')->with('vendor',$vendor);
	}

	//Update the specified resource in storage.\
	public function update($id)
	{
		$vendor = Vendor::find($id);
		$vendor->name = Input::get('name');
		$vendor->description = Input::get('description');
		
		$vendor->user->email = Input::get('email');
		$vendor->user->password = Input::get('password');
		$vendor->user->password_confirmation = Input::get('password_confirmation');

		$vendor->user->validateUniques();
		if ($vendor->validateUniques() && $vendor->user->validateUniques()) {
			$vendor->user->updateUniques();
			$vendor->updateUniques();
            return Redirect::action('VendorController@index')->with('message', "vendor"  . $vendor->name . "was edited!");
        } else {
            return Redirect::action('VendorController@edit', $id)->withErrors(array_merge_recursive($vendor->user->errors()->toArray(), $vendor->errors()->toArray()));
        }
	}

	//Remove the specified resource from storage.
	public function destroy($id)
	{
		$vendor = Vendor::find($id);
		$msg = "vendor " . $vendor->name . " was deleted!";
		$vendor->user->delete();
		$vendor->delete();

		return Redirect::action('VendorController@index')->with('message',$msg);
	}


}