<?php

use Jenssegers\AB\Models\Log as MyLog;

class TrackController extends \BaseController {

	public function youtubeWatchTime()
	{
		$time = Input::get('time');
		Log::info('track youtube time ' . $time);
		AB::logYoutube($time);
	}

	public function imageClick($id)
	{
		$uuid = AB::getUuid();
		if ($uuid == NULL) {
            Log::warning('cannot find session uuid');
            return;  
        }
        $myLog = MyLog::where('uuid', $uuid)->first();
        if ($myLog == NULL) {
        	Log::warning('cannot find matched uuid log');
        	return;
        }

        Log::info('log the click image with uuid ' . $uuid);
        $image = Image::findOrFail($id);
        $log = $image->logs()->where('logs.uuid', $uuid)->first();
        if ($log == NULL) {
        	$image->logs()->attach($myLog->id, ['count' => 1]);
        } else {
	        $log->pivot->count++;
	    	$log->pivot->save();
        }
	}


}
