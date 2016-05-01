@extends('layout')

@section('head')    
	
	<meta property="og:url" content='{{ Request::url() }}'/>
	<meta property="og:title" content='{{{ $product->title }}}'/>
	<meta property="og:description" content='{{{ $product->rightDesc }}}'/>
	<meta property="og:image" content='{{ asset($product->images[0]->src) }}'/>

	@if($product->video != '')
		<script src="/js/youtuber.js"></script>
		<script src="/js/tracker.js"></script>

		<script>
			// Load youtube API
			(function() {
				var tag = document.createElement('script');
				tag.src = "https://www.youtube.com/iframe_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
			})();

			function onYouTubeIframeAPIReady() {
				youtuber.set('youtuber');
				youtuber.init(tracker);
			}

			window.onunload = function() {
				tracker.youtubeTime(youtuber.getCurrentTime());
			}
		</script>
	@endif

@stop


@section('body')    
	<header class="page-header">
		<h1 class="hidden-xs">{{{ $product->title }}}</h1>
		<h3 class="visible-xs">{{{ $product->title }}}</h3>
	</header>

	<div class="container middle-frame" ng-controller='galleryCtrl' 
		ng-init="init('{{{ asset($product->images[0]->src) }}}',
						{{{ json_encode($product->video) }}})">

		<!-- Left Side thumbnails -->
		<div class="col-md-2 col-sm-2 hidden-xs vertical-thumbnail-frame">
			@foreach($product->images as $key => $image)
				{{ View::make('thumbnail', ['key' => $key, 'product' => $product, 'image' => $image]) }}
			@endforeach
		</div>

		<!-- Main Image / Video -->
		<div class="col-md-8 col-sm-8">
			<img ng-src="{[{ mainImageSrc }]}"
				 ng-hide="isVideoDisplay"
				class="img-responsive img-thumbnail" >

			@if($product->video != '')
				<div class="embed-responsive embed-responsive-4by3"
					 ng-show="isVideoDisplay">
					<iframe id="youtuber" class="youtuber embed-responsive-item" 
						src="{{ $product->video->src }}{{ $autoplay ? '?rel=0&autoplay=1&':'?' }}version=3&enablejsapi=1&showinfo=1&controls=1"
						allowfullscreen></iframe>					
				</div>
			@endif
		</div>

		<!-- XS thumbnail (for mobile) -->
		<div class="visible-xs horizontal-thumbnail-frame">
			@foreach($product->images as $key => $image)
				{{ View::make('thumbnail', ['key' => $key, 'product' => $product, 'image' => $image]) }}
			@endforeach
		</div>

		<!-- Right Side price / information -->
		<div class="col-md-2 col-sm-2">
			<h3 class="text-warning">
				<small>價格 : </small>$ {{{ $product->price }}}
			</h3>
			<article>
				{{ nl2br(e($product->rightDesc)) }}
			</article>
			<a role="button" class="btn btn-warning" href='{{ URL::to("product/" . $product->prefix . "/buy") }}'>前往購買</a>
		</div>
	</div>
	<hr>
	<div class="container">
		<h3>關於商品</h3>
		{{ nl2br($product->bottomDesc) }}
	</div>
	
@stop
