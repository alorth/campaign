<!doctype html>


<html>
    <head>
    	<title>{{{ $title }}}超值特惠!!</title>
    	
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js"></script>

        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
 		<link rel="stylesheet" href="/lib/bootstrap.min.css">   	

        <script src="/js/galleryCtrl.js"></script>
        <link rel="stylesheet" href="/css/shop.css">   	

    	<script>
    		$(document).ready(function() {
				
			});
    	</script>    	
    	
    </head>
    <body class="container" ng-app="shopApp" >
		<header class="page-header">
			<h1>{{{ $title }}}</h1>
		</header>

		<div class="container middle-frame" ng-controller='galleryCtrl' 
			ng-init="init({{{ json_encode($images) }}},
							{{{ json_encode($video) }}})">

			<!-- Left Side thumbnails -->
			<div class="col-md-2">
				@foreach($images as $key => $image)
					<p>
						<img ng-src={{{ asset($image) }}} 
							@if($video != '' && $image == $video['image'])
								ng-click="clickSideVideo('{{{ asset($video['image']) }}}');
										focusSideImage({{{ $key }}})"
							@else
								ng-click="clickSideImage('{{{ asset($image) }}}');
										focusSideImage({{{ $key }}})"
								ng-mouseover="mouseoverSideImage('{{{ asset($image) }}}')"
								ng-mouseleave="mouseleaveSideImage()"
							@endif														
							ng-class="thumbnailClass[{{{ $key }}}]"
							class="img-responsive img-thumbnail"
							style="cursor: pointer;">
					</p>
				@endforeach
			</div>
			<!-- Main Image / Video -->
			<div class="col-md-8">
				<img ng-src="{[{ mainImageSrc }]}"
					 ng-hide="isVideoDisplay"
					class="img-responsive img-thumbnail" >

				@if($video != '')
					<div class="embed-responsive embed-responsive-4by3"
						 ng-show="isVideoDisplay">
						<iframe class="youtuber embed-responsive-item" 
							src="{{ $video['src'] }}{{ $autoplay ? '?rel=0&autoplay=1&':'?' }}version=3&enablejsapi=1"
							allowfullscreen></iframe>					
					</div>
				@endif
			</div>

			<!-- Right Side price / information -->
			<div class="col-md-2">
				<h3 class="text-warning">
					<small>價格 : </small>$ {{{ $price }}}
				</h3>
				<article>
					{{ nl2br(e($rightDesc)) }}
				</article>
				<a role="button" class="btn btn-warning" href="{{ URL::to('/buy') }}">前往購買</a>
			</div>
		</div>
		<hr>
		<div class="container">
			<h3>關於商品</h3>
			{{ nl2br(e($bottomDesc)) }}
		</div>
		
    </body>
</html>