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

        <script>
            $(document).ready(function() {
                if ('{{ Session::get("message") }}' != '') {
                    alert('{{ Session::get("message") }}');
                }

                fbq('track', 'ViewContent');
            });
        </script>

        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '1006267286088842');
        fbq('track', "PageView");</script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1006267286088842&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->
    	
    </head>
    <body ng-app="shopApp" >
        <div class="container">
	       @yield('body')
        </div>

        <br>

        <footer>
            <div class="container">
                <div class="col-md-1 col-sm-2 col-xs-6">
                    <img class="img-responsive img-thumbnail" src="{{ asset('images/logo.png') }}">
                </div>
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <h2>Alorth <small>new era of mobile commerce</small></h2>                    
                </div>
                <div class="visible-xs col-xs-12">
                    <hr>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <address>
                        <strong>Alorth, Inc.</strong><br>
                        156 2ND STREET, <br>
                        SAN FRANCISCO, CA 94105
                    </address>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    聯絡我們 : <a href="mailto:admin@alorth.com">admin@alorth.com</a>
                </div>
            </div>
        </footer>
    </body>
</html>