@extends('layout')

@section('head')
	<meta property="og:url" content='{{ Request::url() }}'/>
	<meta property="og:title" content='Alorth 訂購平台'/>
	<meta property="og:description" content='我們提供多樣化的商品及最實惠的價格'/>
	<meta property="og:image" content='{{ asset("images/origin_logo.png") }}'/>

@stop

@section('body')    
	<div class="page-header text-center">
		<img class="center-block img-responsive" src="{{ asset('images/origin_logo.png') }}">
		<img class="center-block img-responsive img-thumbnail" src="{{ asset('images/combine.jpg') }}">

		<hr> 
		<p>Alorth平台提供最多樣化的商品影片，您可直接購買，送至您所在的地方</p>
		<p>並提供方便快速的影片拍攝功能，簡單將您的商品上架銷售</p>
		
		<a href="https://itunes.apple.com/app/id1045919935">
			<img src="{{ asset('images/apple_download.png') }}">
		</a>


	</div>

	<div>
		
	</div>

@stop