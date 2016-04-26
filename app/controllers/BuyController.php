<?php

class BuyController extends \BaseController {

	public function showBuy()
	{
		$title = Cookie::get('title');
		if (is_null($title)) {
			return;
		}

		return View::make('buy', [
			'title' => $title
		]);
	}


}
