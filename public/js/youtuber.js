var youtuber = (function(){
	var player;
	var tracker;

	return {
		set: function(id) {
			player = new YT.Player(id);
		},
		init: function(myTracker) {
			tracker = myTracker;
			player.addEventListener("onStateChange", function(state){
				// Player end
			    if(state.data === 0){
			    	var isFinish = true;
			     	tracker.youtubeTime(player.getCurrentTime(), isFinish);
			    }
			});
		},
		stopVideo: function() {
			player.stopVideo();
		},
		getCurrentTime: function() {
			return player.getCurrentTime();
		}
	};
})();