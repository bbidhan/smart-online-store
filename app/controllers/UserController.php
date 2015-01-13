<?php

class UserController extends BaseController {
	//Display a listing of the resource.
	public function index()
	{
		$users = User::all();
		$users = User::paginate(30);
		return View::make('admin.user')->with('users',$users)->withMenu('3');
	}

	//Show the form for creating a new resource.
	public function create()
	{
		return View::make('admin.create_user');//->with('user',$user);
	}

	//Store a newly created resource in storage.
	public function store()
	{
		$user = new User;
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->password = Input::get('password'); //does this need to be hashed?
		$user->password_confirmation = Input::get('password_confirmation');

		$is_admin = Input::get('is_admin');
		if($is_admin == false){
			$customer = new Customer;
		} else {
			$customer = new Admin;
		}
		$customer->firstname = Input::get('firstname');
		$customer->lastname = Input::get('lastname');
		$customer->phone = Input::get('phone');

		$customer->validateUniques();
		if ($user->validateUniques() && $customer->validateUniques()) {
			$customer->recommended_products = "533,549,558,336,294,978,330,16,244,290";
			$customer->save();
			$user->role_id = $customer->id;
			if($is_admin == false){
				$user->role_type = 'customer';
			} else {
				$user->role_type = 'admin';
			}
			$user->save();
            return Redirect::action('UserController@index')->with('message', 'A new user was created!');
        } else {
            return Redirect::action('UserController@create')->withErrors(array_merge_recursive($user->errors()->toArray(), $customer->errors()->toArray()));
        }
	}

	//Display the specified resource.
	public function show($id)
	{
		echo "Hello User #" . $id;
	}

	//Show the form for editing the specified resource.
	public function edit($id)
	{
		$user = User::find($id);
		return View::make('admin.edit_user')->with('user',$user);
	}

	//Update the specified resource in storage.\
	public function update($id)
	{
		$user = User::find($id);
		$user->email = Input::get('email');
		$user->password = Input::get('password');
		$user->password_confirmation = Input::get('password_confirmation');

		$user->role->firstname = Input::get('firstname');
		$user->role->lastname = Input::get('lastname');
		$user->role->phone = Input::get('phone');

		$user->role->validateUniques();
		if ($user->validateUniques() && $user->role->validateUniques()) {

			$user->role->updateUniques();
			$user->updateUniques();
            return Redirect::action('UserController@index')->with('message', "User '" . $user->role->firstname . " " .$user->role->lastname . "' was edited!");
        } else {
            return Redirect::action('UserController@edit', $id)->withErrors(array_merge_recursive($user->errors()->toArray(), $user->role->errors()->toArray()));
        }
	}

	//Remove the specified resource from storage.
	public function destroy($id)
	{
		$user = User::find($id);
		$msg = "User '" . $user->firstname . " " .$user->lastname . "' was deleted!";
		$user->role->delete();
		$user->delete();

		return Redirect::action('UserController@index')->with('message',$msg);
	}

	public function showWishlist()
	{
		return View::make('wishlist');
	}
	public function showMyOrders()
	{
		$user = Auth::user();
		$customer = $user->role;
		
		return View::make('myorders')->withOrders($customer->orders);
	}	
	public function showOrders($order_id)
	{
		$user = Auth::user();
		$customer = $user->role;
		$order = $customer->orders[$order_id];
		if($order == null)
			return Redirect::action('UserController@showMyOrders')->with('message','Order not found!');
		
		$str = $order->items;
		$products_ids = explode(',', $str);
		$qty = array_count_values($products_ids);

		$products = Product::whereIn('id', $products_ids)->get();
		$products->tot = 0;
		$products->netTot = 0;
		$products->dis = 0;
		$products->tax = 0;
		foreach($products as $product){
			$product->qty = $qty[$product->id];
			$product->tax = $product->price * 0.13 * $product->qty;
			$product->total = ($product->price  * 1.13 - $product->discount/100*$product->price) * $product->qty;
			$products->dis = $product->discount * $product->qty;

			$products->tot = $products->tot + $product->price * $product->qty;
			$products->netTot = $products->netTot + $product->total;
			$products->dis = $products->dis + $product->discount;
			$products->tax = $products->tax + $product->tax;
		}
		return View::make('orders')->withProducts($products);
	}

}