var tracker = (function() {
	var isYoutubeFinish = false;

	function youtubeTime(time, isFinish) {
		// When the player is finished, don't need to track again
		if (isYoutubeFinish == true) {
			return;
		}
		isYoutubeFinish = isFinish;
	    $.ajax({
	    	url: '/youtube',
	    	type: 'post',
	    	async: false,
	    	data: {
	    		time: time
	    	},
	    });

	}

	return {
		youtubeTime: youtubeTime
	};

})();