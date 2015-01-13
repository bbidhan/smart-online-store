<?php

class ProductController extends BaseController {

	//Display a listing of the resource.
	public function index()
	{
		$products = Product::all();
		$products = Product::paginate(10);
		return View::make('admin.product')
					->with('products',$products)
					->withMenu('4');
	}

	//Show the form for creating a new resource.
	public function create()
	{
		return View::make('admin.create_product');
	}

	//Store a newly created resource in storage.
	public function store()
	{
		$product = new Product;
		$product->name = Input::get('name');
		$product->description = Input::get('description');
		$product->price = Input::get('price');
		$product->discount = Input::get('discount');
		$product->stock = Input::get('stock');
		if($product->save())
		{
           return Redirect::action('ProductController@index')->with('message', 'A new product was added!');
		 }
         else {
            return Redirect::action('ProductController@create')->withErrors($product->errors());
        }
		}
	

	//Display the specified resource.
	public function show($id)
	{
	    $product = Product::find($id);
		
		 echo $product->description ;
		}

	//Show the form for editing the specified resource.
	public function edit($id)
	{
		$product = Product::find($id);
		return View::make('admin.edit_product')->with('product',$product);
	}

	//Update the specified resource in storage.\
	public function update($id)
	{
		$product = Product::find($id);
		$product->name = Input::get('name');
		$product->description = Input::get('description');
		$product->price = Input::get('price');
		$product->discount = Input::get('discount');
		$product->stock = Input::get('stock');
		if ($product->updateUniques()) {
            return Redirect::action('ProductController@index')->with('message', "product"  . $product->name . "was edited!");
        } else {
            return Redirect::action('ProductController@edit', $id)->withErrors($user->errors());
        }
	}

	//Remove the specified resource from storage.
	public function destroy($id)
	{
		$product = Product::find($id);
		$msg = "Product " . $product->name . " was deleted!";
		$product->delete();

		return Redirect::action('ProductController@index')->with('message',$msg);
	}

	public function showProduct($id){
		$product = Product::find($id);

		$str = $product->related_products;
		$products_ids = explode(',', $str);
		$relProducts = Product::whereIn('id', array_slice($products_ids, 1, 5))->get();
		return View::make('product')
				->with('product',$product)
				->with('relProducts',$relProducts)
				;
	}


}