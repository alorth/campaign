<!doctype html>


<html>
    <head>
    	<title>Alorth 訂購平台</title>
    	
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:site_name" content="Alorth 訂購平台"/>
        <meta property="og:type" content="website"/>        

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js"></script>

        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
 		<link rel="stylesheet" href="/lib/bootstrap.min.css">   	

        <script src="/js/galleryCtrl.js"></script>
        <link rel="stylesheet" href="/css/shop.css">   	

    	@yield('head')
    	
    </head>
    <body ng-app="shopApp" >
    	<!-- <nav class="navbar navbar-default">
    		<div class="container container-fluid">
    			<div class="navbar-header">    				
    				<img class="navbar-brand" src="{{ asset('images/logo.png') }}" >
    				<a class="navbar-brand" href="">Alorth</a>
    			</div>
                <p class="navbar-text">new era of mobile commerce</p>
    		</div>			            
		</nav> -->

        <div class="container">
	       @yield('body')
        </div>

        <br>

        <footer>
            <div class="container">
                <div class="col-md-1">
                    <img class="img-responsive img-thumbnail" src="{{ asset('images/logo.png') }}">
                </div>
                <div class="col-md-5">
                    <h2>Alorth <small>new era of mobile commerce</small></h2>                    
                </div>
                <div class="col-md-3">
                    <address>
                        <strong>Alorth, Inc.</strong><br>
                        156 2ND STREET, <br>
                        SAN FRANCISCO, CA 94105
                    </address>
                </div>
                <div class="col-md-3">
                    聯絡我們 : <a href="mailto:admin@alorth.com">admin@alorth.com</a>
                </div>
            </div>
        </footer>
    </body>
</html>