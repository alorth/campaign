<?php

class BuyController extends \BaseController {

	public function showBuy($prefix)
	{
		$title = Cookie::get('title');
		if (is_null($title)) {
			return;
		}
		AB::complete('buy');
		return View::make('buy', [
			'title' => $title,
			'price' => Cookie::get('price'),
			'prefix' => $prefix
		]);
	}

	public function submit($prefix)
	{
		AB::complete('submit');
		Customer::create([
			'product' => Input::get('product'),
			'price' => Input::get('price'),
			'number' => Input::get('number'),
			'ship' => Input::get('ship'),
			'address' => Input::get('address'),
			'email' => Input::get('email'),
			'other' => Input::get('other'),
			'name' => Input::get('name'),
			'phone' => Input::get('phone')
		]);
		return Redirect::to($prefix)->with('message', '成功寄出 !');
	}


}
