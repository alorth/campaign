var app = angular.module("shopApp", []);

app.config(function($interpolateProvider) {
	$interpolateProvider.startSymbol('{[{');
	$interpolateProvider.endSymbol('}]}');
});

app.controller("galleryCtrl", function($scope) {

	var buffer = {
		originMainImageSrc: '',
		video: ''
	};

	$scope.init = function(image, video) {
		$scope.mainImageSrc = image;
		$scope.isVideoDisplay = video != '' ? true : false;
		buffer.video = video;
		$scope.focusSideImage(0);
	};

	$scope.clickSideImage = function(image) {
		if(buffer.video != '') {
			youtuber.stopVideo();
			$scope.isVideoDisplay = false;
		}
		$scope.mainImageSrc = image;
		buffer.originMainImageSrc = image;
	};

	$scope.clickSideVideo = function(image) {
		$scope.isVideoDisplay = true;
	}

	$scope.mouseoverSideImage = function(image) {
		buffer.originMainImageSrc = $scope.mainImageSrc;
		$scope.mainImageSrc = image;
	};

	$scope.mouseleaveSideImage = function() {
		$scope.mainImageSrc = buffer.originMainImageSrc;
	};

	$scope.focusSideImage = function(key) {
		$scope.thumbnailClass = [];
		$scope.thumbnailClass[key] = 'border-highlight';
	}
});
