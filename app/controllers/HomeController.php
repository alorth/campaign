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
		Cookie::queue('price', $data['price'], 60);

		// AB testing , if user isn't in video experiment, clear it
		if (AB::experiment($prefix . '/video')) {
			array_unshift($data['images'], $data['video']['image']);
		} else {
			$data['video'] = '';
		}
		return View::make('shop', array_merge($data, ['prefix' => $prefix]));
	}

	public function showMinions()
	{
		// Product information start ---
		$title = '神偷奶爸II 互動音效黃色小小兵 KEVIN 凱文 BANANA';
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
			"商品狀況 : 全新品
			 所在地區 : 台北市
			 付款方式 : 貨到付款
			 寄送方式 : 快遞
			";
		$bottomDesc = 
			"Alorth 所販售商品皆是原廠包裝未拆封，如收到時發現商品內容有瑕疵或缺件
			請與admin@alorth.com聯絡，我們將會盡速為您處理。
			※ 產品顏色會因網頁呈現而有些許差異，網頁圖片僅供參考，以收到實品為準。
			※ 產品規格若敘述有誤，請以實物為主。
			※ 欲退貨的商品必須為全新狀態且完整包裝，一經拆封使用或拆解導致缺乏完整性，恕無法做退貨動作。
			※ 運送過程外盒偶有碰撞擠壓，但並不損及內盒產品完整性；如嚴格要求外盒完整與八角無損者，購買前敬請三思。
			";
		$price = 1400;
		// Product information stop ---

		return $this->makeView('minions', [
			'title' => $title,
			'images' => $images,
			'video' => $video,
			'rightDesc' => $rightDesc,
			'bottomDesc' => $bottomDesc,
			'price' => $price,
			'autoplay' => true
		]);
	}

	public function showLipstick()
	{
		// Product information start ---
		$title = '宋慧喬LANEIGE蘭芝雙色唇膏 超放電絲絨雙色唇膏(2g) 3號 現貨';
		$images = [
			'images/lipstick/1.jpg',
			'images/lipstick/2.jpg',
			'images/lipstick/3.jpg',
		];
		$video = [
			'image' => 'images/lipstick/0.png',
			'src' => 'https://www.youtube.com/embed/1oNA9hUz8xc'
		];
		
		$rightDesc = 
			"商品狀況 : 全新品
			 所在地區 : 台北市
			 付款方式 : 貨到付款
			 寄送方式 : 快遞
			";
		$bottomDesc = 
			"Alorth 所販售商品皆是原廠包裝未拆封，如收到時發現商品內容有瑕疵或缺件
			請與admin@alorth.com聯絡，我們將會盡速為您處理。
			※ 產品顏色會因網頁呈現而有些許差異，網頁圖片僅供參考，以收到實品為準。
			※ 產品規格若敘述有誤，請以實物為主。
			※ 欲退貨的商品必須為全新狀態且完整包裝，一經拆封使用或拆解導致缺乏完整性，恕無法做退貨動作。
			※ 運送過程外盒偶有碰撞擠壓，但並不損及內盒產品完整性；如嚴格要求外盒完整與八角無損者，購買前敬請三思。
			";
		$price = 780;
		// Product information stop ---

		return $this->makeView('lipstick', [
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
