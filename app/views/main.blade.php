@extends('layout')

@section('head')
	<meta property="og:url" content='{{ Request::url() }}'/>
	<meta property="og:title" content='Alorth 訂購平台'/>
	<meta property="og:description" content='我們提供多樣化的商品及最實惠的價格'/>
	<meta property="og:image" content='{{ asset("images/origin_logo.png") }}'/>

@stop

@section('body')    
	<div class="page-header text-center">
		<img class="center-block" src="{{ asset('images/origin_logo.png') }}">

		<p>我們提供多樣化的商品及最實惠的價格</p>
	</div>

	<div>
		<div class="col-md-4 col-md-offset-2 text-center">
			<h3>神偷奶爸II 互動音效黃色小小兵 KEVIN 凱文 BANANA</h3>
			<img src="images/minors/0.jpg" class="img-responsive img-thumbnail">
			<br><br>
			<a class="btn btn-primary btn-lg" href="{{ URL::to('minions') }}" role="button">更多資訊</a>
		</div>
		<div class="col-md-4 text-center">
			<h3>宋慧喬LANEIGE蘭芝雙色唇膏 超放電絲絨雙色唇膏(2g) 3號 現貨</h3>
			<img src="images/lipstick/1.jpg" class="img-responsive img-thumbnail">
			<br><br>
			<a class="btn btn-primary btn-lg" href="{{ URL::to('lipstick') }}" role="button">更多資訊</a>
		</div>
	</div>

@stop