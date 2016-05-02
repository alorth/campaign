var tracker = (function() {
	var isYoutubeFinish = false;

	return {
		youtubeTime: function(time, isFinish) {
			// When the player is finished, don't need to track again
			if (isYoutubeFinish == true) {
				return;
			}
			isYoutubeFinish = isFinish;
		    $.ajax({
		    	url: '/track/youtube',
		    	type: 'post',
		    	async: false,
		    	data: {
		    		time: time
		    	},
		    });
		},
		imageClick: function(id) {
			$.ajax({
		    	url: '/track/image/' + id,
		    	type: 'post',
		    });
		}
	};

})();