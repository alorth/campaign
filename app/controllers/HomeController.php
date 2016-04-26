<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showSample()
	{
		// Product information start ---
		$title = '商品名稱';
		$images = [
			'images/1.png',
			'images/2.png'
		];
		$video = [
			'image' => 'images/0.png',
			'src' => 'https://www.youtube.com/embed/qXDw0iMCmUk'
		];
		
		$rightDesc = 
			"右側欄
			這是第二行
			";
		$bottomDesc = 
			"下邊欄
			這是第二行
			";
		$price = 300;
		// Product information stop ---

		return $this->makeView('sample', [
			'title' => $title,
			'images' => $images,
			'video' => $video,
			'rightDesc' => $rightDesc,
			'bottomDesc' => $bottomDesc,
			'price' => $price,
			'autoplay' => true
		]);
	}

	private function makeView($prefix, $data)
	{
		// Record the title of product, then it can be used to shop
		Cookie::queue('title', $data['title'], 60);

		// AB testing , if user isn't in video experiment, clear it
		if (AB::experiment($prefix . '/video')) {
			array_unshift($data['images'], $data['video']['image']);
		} else {
			$data['video'] = '';
		}
		return View::make('sample', $data);
	}

	public function showMinors()
	{
		// Product information start ---
		$title = 'Minions Kevin Banana Eating Action Figure';
		$images = [
			'images/minors/0.jpg',
			'images/minors/1.jpg',
			'images/minors/2.jpg',
		];
		$video = [
			'image' => 'images/0.png',
			'src' => 'https://www.youtube.com/embed/qXDw0iMCmUk'
		];
		
		$rightDesc = 
			"* Soft skin upper body
			 * Move head left, right, forward & back for reactions
			 * Articulated arms, original voice with sound effects
			 * Put banana to his mouth to activate special function
			";
		$bottomDesc = 
			"Talking Kevin with interactive accessory with soft skin upper body. 
			 Move head left, right, forward & back for reactions.
			";
		$price = 19.89;
		// Product information stop ---

		return $this->makeView('minors', [
			'title' => $title,
			'images' => $images,
			'video' => $video,
			'rightDesc' => $rightDesc,
			'bottomDesc' => $bottomDesc,
			'price' => $price,
			'autoplay' => true
		]);
	}


	

}
