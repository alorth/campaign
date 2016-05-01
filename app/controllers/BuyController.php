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

	public function showReport()
	{
		// Setup the file descriptors
	    $descriptors = [
	        0 => ['pipe', 'w'],
	        1 => ['pipe', 'w'],
	        2 => ['pipe', 'w'],
	    ];

	    $cmd = 'php artisan ab:report';
	    // Start the script
	    $proc = proc_open($cmd, $descriptors, $pipes);

	    // Read the stdin
	    $stdin = stream_get_contents($pipes[0]);
	    fclose($pipes[0]);

	    // Read the stdout
	    $stdout = stream_get_contents($pipes[1]);
	    fclose($pipes[1]);

	    // Read the stderr
	    $stderr = stream_get_contents($pipes[2]);
	    fclose($pipes[2]);

	    // Close the script and get the return code
	    $return_code = proc_close($proc);

    	print nl2br($stdout);
	}


}
