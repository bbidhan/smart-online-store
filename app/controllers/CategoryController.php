<?php

class CategoryController extends BaseController {

	public function showProducts($id){
		$category = Category::find($id);
		if($category){
			$products = $category->products;
			//$products = Product::paginate(10);
			return View::make('category')
				->withProducts($products)
				//->withCategories($categories)
				;
		} else {
			return Redirect::to('/')->withMessage('khaate hack haancha');
		}
	}
}