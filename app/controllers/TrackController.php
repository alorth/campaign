<?php

class TrackController extends \BaseController {

	public function youtubeWatchTime()
	{
		$time = Input::get('time');
		Log::info('track youtube time ' . $time);
		AB::logYoutube($time);

	}


}
