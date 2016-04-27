@extends('layout')

@section('head')    
	
	<meta property="og:url" content='{{ Request::url() }}'/>
	<meta property="og:title" content='{{{ $title }}}'/>
	<meta property="og:description" content='{{{ $rightDesc }}}'/>
	<meta property="og:image" content='{{ asset($images[0]) }}'/>

@stop


@section('body')    
	<header class="page-header">
		<h1>{{{ $title }}}</h1>
	</header>

	<div class="container middle-frame" ng-controller='galleryCtrl' 
		ng-init="init({{{ json_encode($images) }}},
						{{{ json_encode($video) }}})">

		<!-- Left Side thumbnails -->
		<div class="col-md-2 col-sm-2 hidden-xs vertical-thumbnail-frame">
			@foreach($images as $key => $image)
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
			@endforeach
		</div>

		<!-- Main Image / Video -->
		<div class="col-md-8 col-sm-8">
			<img ng-src="{[{ mainImageSrc }]}"
				 ng-hide="isVideoDisplay"
				class="img-responsive img-thumbnail" >

			@if($video != '')
				<div class="embed-responsive embed-responsive-4by3"
					 ng-show="isVideoDisplay">
					<iframe class="youtuber embed-responsive-item" 
						src="{{ $video['src'] }}{{ $autoplay ? '?rel=0&autoplay=1&':'?' }}version=3&enablejsapi=1&showinfo=1&controls=0"
						allowfullscreen></iframe>					
				</div>
			@endif
		</div>

		<!-- XS thumbnail (for mobile) -->
		<div class="visible-xs horizontal-thumbnail-frame">
			@foreach($images as $key => $image)
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
			@endforeach
		</div>

		<!-- Right Side price / information -->
		<div class="col-md-2 col-sm-2">
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
	
@stop
