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
	public function show($id)
	{
		$product = Product::with(['images', 'video'])->findOrFail($id);

		// AB testing , if user isn't in video experiment, clear it
		// if (AB::experiment($product->prefix . '/video')) {
		// 	array_unshift($product->images, $product->video->image);
		// } else {
		// 	$product->video = '';
		// }

		return View::make('shop', [
			'prefix' => $product->prefix,
			'title' => $product->title,
			'images' => $product->images,
			'video' => $product->video,
			'rightDesc' => $product->rightDesc,
			'bottomDesc' => $product->bottomDesc,
			'price' => $product->price,
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
