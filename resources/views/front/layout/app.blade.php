<!doctype html>
<html class="no-js" lang="en">


<head>
	<meta charset="utf-8">
	<title>Hunttr</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- site favicon -->
	<link rel="icon" type="image/png" href="{{asset('front/assets/images/hunt.png')}}">
	<!-- Place favicon.ico in the root directory -->

	<!-- All stylesheet and icons css  -->
	<link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('front/assets/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('front/assets/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('front/assets/css/swiper.min.css')}}">
	<link rel="stylesheet" href="{{asset('front/assets/css/lightcase.css')}}">
	<link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">

    @yield('extra_css')

</head>
<body>
	<!-- preloader start here -->

    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

	<!-- preloader ending here -->

	<!-- scrollToTop start here -->

    <a href="#" class="scrollToTop"><i class="fa-solid fa-angle-up"></i></a>

    <!-- scrollToTop ending here -->

   @include('front.header.header')
   @yield('content')
   @include('front.footer.footer')



    
        <!-- All Needed JS -->
	<script src="{{asset('front/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
	<script src="{{asset('front/assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>
	<script src="{{asset('front/assets/js/isotope.pkgd.min.js')}}"></script>
	<script src="{{asset('front/assets/js/swiper.min.js')}}"></script>
	<script src="{{asset('front/assets/js/all.min.js')}}"></script>
	<script src="{{asset('front/assets/js/wow.js')}}"></script>
	<script src="{{asset('front/assets/js/counterup.js')}}"></script>
	<script src="{{asset('front/assets/js/jquery.countdown.min.js')}}"></script>
	<script src="{{asset('front/assets/js/lightcase.js')}}"></script>
	<script src="{{asset('front/assets/js/waypoints.min.js')}}"></script>
	<script src="{{asset('front/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('front/assets/js/plugins.js')}}"></script>
	<script src="{{asset('front/assets/js/main.js')}}"></script>
    
    <script>
		window.ga = function () {
			ga.q.push(arguments)
		};
		ga.q = [];
		ga.l = +new Date;
		ga('create', 'UA-XXXXX-Y', 'auto');
		ga('set', 'anonymizeIp', true);
		ga('set', 'transport', 'beacon');
		ga('send', 'pageview')
	</script>
	<script src="../../../../www.google-analytics.com/analytics.js" async></script>

    @yield('extra_js')
</body>