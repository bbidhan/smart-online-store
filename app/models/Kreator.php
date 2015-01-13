<?php

class Kreator {

	public static $user_id = 1752;

	public static function saveOneOrder($prods)
	{
		$prod_str = implode($prods,",");
		$order = new Order;

		$qty = array_count_values($prods);

		$products = Product::whereIn('id', $prods)->get();
		$products->netTot = 0;

		foreach($products as $product){
			$product->qty = $qty[$product->id];
			$product->tax = $product->price * 0.13 * $product->qty;
			$product->total = ($product->price  * 1.13 - $product->discount/100*$product->price) * $product->qty;
			
			$products->netTot = $products->netTot + $product->total;
		}
		$starting_time = new DateTime('NOW');
		$starting_time->modify('+2 hour');

		$order->customer_id = self::$user_id;
		$order->items = $prod_str;
		$order->eta = $starting_time;
		$order->price = $products->netTot;
		$order->location_id = 0;
			print_r("Customer ".self::$user_id);
			print_r(" Ordered ".$prod_str."</br>");
		// if($order->save()){}
		
	}	
	public static function saveOrdersTopwise($times,$products_ids,$products_ids_top)
	{
		//buy top 10 products 50% of the times...
		$times_top = ceil($times /2);
		$times -= $times_top;

		for ($j=0; $j < $times_top ; $j++) {
			shuffle($products_ids_top);
			//buy random 1-3 '''top''' items at once
		 	$prods = array_slice($products_ids_top,0,mt_rand(1,3));
			self::saveOneOrder($prods);	
		}
		for ($j=0; $j < $times ; $j++) {
			shuffle($products_ids);
			//buy random 1-3 '''top''' items at once
		 	$prods = array_slice($products_ids,0,mt_rand(1,3));
			self::saveOneOrder($prods);	
		}
	}	
	public static function saveOrdersCatwise($cats,$loyality)
	{
		$products_ids = array();
		$products_ids_top = array();

		foreach ($cats as $cat) {
			$products = Category::find($cat)->products;
			//buy top 10 products
			$products_top = $products->take(10);
			
			foreach ($products as $prod) {
				 array_push($products_ids, $prod->id);
			}
			foreach ($products_top as $prod) {
				 array_push($products_ids_top, $prod->id);
			}
		}
		if($loyality == 0)
			$times = mt_rand(1,5);
		else if($loyality == 1)
			$times = mt_rand(6,20);
		else
			$times = mt_rand(21,30);

		// print_r("Customer ".self::$user_id);
		// print_r(" Ordered ".$times." items</br>");
		self::saveOrdersTopwise($times,$products_ids,$products_ids_top);
	}
	public static function saveOrdersUserswise($personas)
	{
		foreach ($personas as $persona) {
			$size = ceil(5000*$persona[1]);
			for ($i=0; $i < floor($size * .6) ; $i++) { 
				self::saveOrdersCatwise($persona[0],0);
				self::$user_id++;
			}
			for ($i=0; $i < ceil($size * .3) ; $i++) { 
				self::saveOrdersCatwise($persona[0],1);
				self::$user_id++;
			}
			for ($i=0; $i < floor($size * .1) ; $i++) { 
				self::saveOrdersCatwise($persona[0],2);
				self::$user_id++;
			}
		}
	}

	public static function kreate()
	{
		set_time_limit(0);
		$personas = array(
		//<18 MALE
			array( [25,26,27,39,40,43],.1*.5* .4), //Normal
			array( [25,26,27], .1*.5* .25 ), //Bookworm
			array( [26,27,42,43], .1*.5* .15 ), //Geek
			array( [25,5,8,22,40,43], .1*.5* .2 ), //Needs gf
		//<18 FEMALE
			array( [25,26,27,39,40,43,15],.1*.5* .4), //Normal
			array( [25,26,27], .1*.5* .25 ), //Bookworm
			array( [25,26,27,42,43], .1*.5* .15 ), //Geek
			array( [25,6,8,13,15,33,37,23,4,43], .1*.5* .2 ), //nakkali
		//18-24 MALE
			array( [5,22,41,42,43,25,27],.25*.5* .4), //Normal
			array( [5,41,42,43,43,22,26], .25*.5* .2 ), //Geek
			array( [25,26,27,41,42,43], .25*.5* .1 ), //Nerd
			array( [5,5,8,22,42,43,40], .25*.5* .2 ), //Needs gf
			array( [5,5,8,22,41,42,43,33,35], .25*.5* .1 ), //Has gf
		//18-24 FEMALE
			array( [4,6,8,13,43,15,23,25,37],.25*.5* .4), //Normal
			array( [4,6,8,23,25,41,42,43,43], .25*.5* .2 ), //Geek
			array( [6,25,25,26,27,43,36], .25*.5* .1 ), //Bookworm
			array( [4,6,8,13,14,15,16,33,37,35,23,42,43], .25*.5* .3 ), //nakkali
		//24-40 MALE
			array( [5,41,42,43,43,22,26], .55*.5* .05 ), //Geek
			array( [25,26,27,41,42,43], .55*.5* .05 ), //Nerd
			array( [5,5,8,22,42,43,40], .55*.5* .05 ), //Needs gf
			array( [5,5,8,22,41,42,43,33,34,35], .55*.5* .05 ), //Has gf
			array( [5,8,22,12,41,42,43,33,34,35,47,31,32], .55*.5* .25 ), //new marr
			array( [5,7,7,7,7,7,8,22,12,41,42,43,44,24,24,24,24,28,35,47,31,32,38,39,40,30], .55*.5* .40 ), //child
			array( [5,12,41,42,43,43,44,22,27,28,35,47,31,32], .55*.5* .15 ), //child
		//24-40 FEMALE
			array( [4,6,8,23,25,41,42,43,43], .55*.5* .05 ), //Geek
			array( [6,25,25,26,27,43,36], .55*.5* .05 ), //Bookworm
			array( [4,6,8,9,13,14,15,16,33,37,35,36,23,42,43], .55*.5* .1 ), //nakkali
			array( [4,5,6,8,9,13,14,15,16,33,34,37,35,36,23,43,31,46], .55*.5* .25 ), //new mar
			array( [4,6,7,7,7,7,7,8,9,10,14,15,16,24,24,28,23,43,45,46,31,29,30,38], .55*.5* .4 ), //child
			array( [4,5,6,7,8,9,10,11,13,14,15,16,24,34,37,23,43,45,46,31,29,29,30,30], .55*.5* .15 ), //child
		//40+ MALE FEMALE
			array( [5,10,12,41,42,43,43,44,22,27,26,34,47,31,32,39], .1*.5 ), //child
			array( [4,6,8,9,10,11,12,13,14,15,16,34,37,23,27,43,45,46,31,29,29,30,30], .1*.5 ), //child
			
			);

		self::saveOrdersUserswise($personas);
		return self::$user_id;
	}


}