<?php

class HomeController extends BaseController {

	public function search()
	{
			$keyword=Input::get('search');

	        $searchKeys = array( 
            $keyword, //keyword itself
            $keyword."%",//starts from keyword
            "% ".$keyword."%",//some word start from keyword
            "%".$keyword,//ends from keyword
            "%".$keyword." %",//some word ends in keyword
            "%".$keyword."%"//contains keyword
            );
		 $resultcount=20;
        $productList = array();
        foreach($searchKeys as $key)
        {
            $result = Product::where("name" , "like" , $key)->take($resultcount)->get();
            foreach($result as $res)
                if( ! in_array($res, $productList))
                    $productList[]=$res;
            if(count($productList) > $resultcount)
            {
                break;
            }
        }
        return View::make('index')
			->withProducts($productList)
			;
	}

	public function test2()
	{
		set_time_limit(0);
		
		$html = new simple_html_dom();
	    $html->load_file("http://www.amazon.co.uk/s/ref=lp_356496011_il_ti_electronics/276-8690140-2341348?rh=n%3A560798%2Cn%3A%21560800%2Cn%3A1340509031%2Cn%3A356496011&ie=UTF8&qid=1390908868&lo=electronics");
		$pids = $html->find("span")->name;

		return $pids;

	}
	public function test()
	{
		set_time_limit(0);
		
		$html = new simple_html_dom();
	    $html->load_file("http://www.yeskantipur.com/index.php?route=product/category&path=70_101&limit=100");

	    for ($i=0; $i < 24; $i++) { 
	    	$url = $html->find(".name a",$i)->href;
	    	$url = substr($url,90);
			$products_ids[$i] = (int)$url;
	    }
	    return $products_ids;
		
		foreach ($products_ids as $p_id) {
			
			$html = new simple_html_dom();
	    	$html->load_file("http://www.yeskantipur.com/index.php?route=product/product&product_id=" . $p_id);

			$desc = $html->find("#tab-description",0);
			if($desc != null)
				$desc = $desc->innertext;

			$title = $html->find(".product_title h1",0)->innertext;

			$price = $html->find(".price",0)->innertext;
			$price = str_replace(' ', '', $price);
			$price = str_replace(',', '', $price);
			$price = substr($price, 9,-5);
			$price = (int)$price;
			
			$product = new Product;
			$product->name = $title;
			$product->vendor_id = Input::get('v_id');
			$product->category_id = Input::get('c_id');
			$product->price = $price;
			$product->stock = 100;
			$product->discount = 0;
			if($desc != null)
				$product->description = $desc;
			else{
				$product->description = "Description 4not found!";
			}
			//$product->img = $html->find(".img",a)->href;
			$product->save();

		}

		return View::make('yes');

	}		
	public function index()
	{
		$rec = Auth::user()->role->recommended_products;
		$products_ids = explode(',', $rec);
		$products = Product::whereIn('id', $products_ids)->get();
		// $products = Product::paginate(10);
		return View::make('index')
			->withProducts($products)
			;
		;
	}	
	public function copyc()
	{
		//set_time_limit(0); 
		$consumers = Consumer::all();
		//return $consumers[0]->email;
		for($i = 0 ; $i < 20; $i++){
			$user = new User;
			$user->email = $consumers[$i]->email;
			$user->username = 'user' . ($i +5156);

			$user->role_id = $i + 1;
			$user->role_type = 'vendor';
			$user->password = 'password';
			echo $user;
			$user->save();
		}		
		//$users = User::all();
		for($i = 11110 ; $i < 3891; $i++){
			$users[$i]->role_id = $i+1;
			$users[$i]->save();
		}

		//return View::make('index');
	}	
	public function about()
	{

		return View::make('about')->withMenu('2');
	}
	public function faq()
	{
		return View::make('faq')->withMenu('3');
	}
	public function contact()
	{
		return View::make('contact')->withMenu('4');
	}

}