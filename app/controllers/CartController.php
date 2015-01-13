<?php

class CartController extends BaseController {


	public function showCart()
	{
		$user = Auth::user();
		$customer = $user->role;

		$str = $customer->cart;
		$products_ids = explode(',', $str);
		$qty = array_count_values($products_ids);

		$products = Product::whereIn('id', $products_ids)->get();
		$products->tot = 0;
		$products->netTot = 0;
		$products->dis = 0;
		$products->tax = 0;
		foreach($products as $product){
			$product->qty = $qty[$product->id];
			$product->tax = $product->price * 0.13;// * $product->qty;
			$product->total = ($product->price  * 1.13 - $product->discount/100*$product->price) * $product->qty;
			$products->dis = $product->discount;// * $product->qty;

			$products->tot = $products->tot + $product->price * $product->qty;
			$products->netTot = $products->netTot + $product->total;
			$products->dis = $products->dis + $product->discount* $product->qty;
			$products->tax = $products->tax + $product->tax* $product->qty;
		}
		return View::make('cart')->withProducts($products);
	}		
	public function plus($product_id)
	{
		$user = Auth::user();
		$customer = $user->role;

		if($customer->cart ==null){
			$customer->cart = $product_id;
		}
		else {
				$customer->cart = $customer->cart . ',' . $product_id;
		}
		
		$customer->updateUniques();
		return Redirect::action('CartController@showCart');
	}		
		public function minus($product_id)
	{
		$user = Auth::user();
		$customer = $user->role;
		$str = $customer->cart;
		$products_ids = explode(',', $str);
		$key = array_search($product_id, $products_ids);
		if($product_id == $products_ids[$key])
			unset($products_ids[$key]);

		$products_ids = implode($products_ids,',');

		$customer->cart = $products_ids;
		$customer->updateUniques();
		return Redirect::action('CartController@showCart');
	}		
	public function add2Cart($id)
	{
		$user = Auth::user();
		$customer = $user->role;
		$qty = Input::get('qty');
		if($customer->cart ==null){
			$customer->cart = $id;
		} else {
			if($qty==null)
				$customer->cart = $customer->cart . ',' . $id;
			else{
				for ($i=0; $i < $qty; $i++) { 
					$customer->cart = $customer->cart . ',' . $id;
				}
			}
		}
		
		$customer->updateUniques();
		return Redirect::action('CartController@showCart');
	}	
	public function removeFromCart($id)
	{
		$user = Auth::user();
		$customer = $user->role;

		$str = $customer->cart;
		$products_ids = explode(',', $str);
		$remove = array($id);
		$result = array_diff($products_ids, $remove); 

		$customer->cart = implode(',', $result);
		$customer->updateUniques();
		return Redirect::action('CartController@showCart');
	}	
	public function finalizeCart()
	{
		$order = new Order;
		$user = Auth::user();
		$customer = $user->role;

		$eta = Input::get('eta');
		$address = Input::get('address');

		//$eta = strtotime(date("Y-m-d H:i:s", strtotime('+'.(int)$eta .' hours')));
		
		$str = $customer->cart;

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
		$starting_time = new DateTime('NOW');
		$starting_time->modify('+'.(int)$eta .' hour');

		$order->customer_id = $customer->id;
		$order->items = $customer->cart;
		$order->eta = $starting_time;
		$order->price = $products->netTot;
		$order->location_id = 0;

		if($order->save()){
			$customer->cart="";
			$customer->updateUniques();
		}
		return Redirect::action('UserController@showMyOrders')->withMessage('You have successfully ordered!');
	}

}