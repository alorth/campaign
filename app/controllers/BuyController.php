<?php

class BuyController extends \BaseController {

	public function showBuy()
	{
		$title = Cookie::get('title');
		if (is_null($title)) {
			return;
		}

		return View::make('buy', [
			'title' => $title,
			'price' => Cookie::get('price')
		]);
	}

	public function buy()
	{
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
		return Redirect::to(Cookie::get('prefix'))->with('message', '成功寄出 !');
	}


}
