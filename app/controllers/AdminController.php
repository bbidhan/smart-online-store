<?php

class AdminController extends BaseController {

	public function index()
	{
		$orders = Order::where('id','>','46767')->get();

		return View::make('admin.index')->withOrders($orders)->withMenu('2');
	}
}
