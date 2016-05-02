<?php

class ProductController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($prefix)
	{
		$product = Product::with(['images', 'video'])->where('prefix', $prefix)->firstOrFail();

		// Record the title of product, then it can be used to shop
		Cookie::queue('title', $product->title, 60);
		Cookie::queue('price', $product->price, 60);

		// AB testing , if user isn't in video experiment, clear it
		if (AB::experiment($product->prefix . '/video')) {
			$product->images->prepend($product->video->thumbnail);
		} else {
			$product->video = '';
		}

		return View::make('product', [
			'product' => $product,
			'autoplay' => true
		]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
