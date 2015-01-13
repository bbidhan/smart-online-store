<?php

class ReviewController extends \BaseController {

	//Display a listing of the resource.
	public function index()
	{
		$reviews = Review::all();
		$reviews = Review::paginate(10);
		return View::make('admin.review')->with('reviews',$reviews)->withMenu('6');
	}

	//Show the form for creating a new resource.
	public function create()
	{
		return View::make('admin.create_review');
	}

	//Store a newly created resource in storage.
	public function store()
	{
		$review = new review;
		$review->name = Input::get('name');
		$review->description = Input::get('description');
		$review->price = Input::get('price');
		$review->discount = Input::get('discount');
		$review->stock = Input::get('stock');
		if($review->save())
		{
           return Redirect::action('reviewController@index')->with('message', 'A new review was added!');
		 }
         else {
            return Redirect::action('reviewController@create')->withErrors($review->errors());
        }
		}
	

	//Display the specified resource.
	public function show($id)
	{
	    $review = review::find($id);
		
		 echo $review->description ;
		}

	//Show the form for editing the specified resource.
	public function edit($id)
	{
		$review = review::find($id);
		return View::make('admin.edit_review')->with('review',$review);
	}

	//Update the specified resource in storage.\
	public function update($id)
	{
		$review = review::find($id);
		$review->name = Input::get('name');
		$review->description = Input::get('description');
		$review->price = Input::get('price');
		$review->discount = Input::get('discount');
		$review->stock = Input::get('stock');
		if ($review->updateUniques()) {
            return Redirect::action('reviewController@index')->with('message', "review"  . $review->name . "was edited!");
        } else {
            return Redirect::action('reviewController@edit', $id)->withErrors($user->errors());
        }
	}

	//Remove the specified resource from storage.
	public function destroy($id)
	{
		$review = review::find($id);
		$msg = "review " . $review->name . " was deleted!";
		$review->delete();

		return Redirect::action('reviewController@index')->with('message',$msg);
	}
}