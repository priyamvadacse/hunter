<!doctype html>
<html class="no-js" lang="en">
<head>
    <!-- site favicon -->
	{{-- <link rel="shortcut icon" type="image/x-icon" href="{{asset('/front/assets/images/hunt.png')}}"> --}}
	<link rel="icon" type="image/x-icon" href="https://hunttr.com/public/front/assets/images/hunt.png" >
	<meta charset="utf-8">
	<title>Find Your Perfect Match | Best Dating Site for Singles | Hunttr</title>
	<link rel="canonical" href="https://hunttr.com/" />
    
<meta name="keywords" content="#1 Trusted Dating App,Best Online Dating App in India, Dating App, Single Person, Online Dating, Meet People, Many Ages, Free Dating, India, Best Dating App " />
<meta name="description" content="Experience genuine connections at Hunttr, the top dating site for singles. Join now to meet your perfect match and ignite lasting love!"/>
<meta property="og:title" content="Most Popular Dating App">
<meta property="og:url" content="https://hunttr.com/">
<meta property="og:description" content="Find genuine connections on Hunttr, India's most trusted dating app. Join thousands of singles exploring meaningful relationships. Swipe, chat, love!">
<meta name="language" content="English">
<meta property="og:type" content="business.business">
<meta name="language" content="English"> 
<meta name="Author" content="Hunttr Dating app" />
<meta name="e-mail" content="info@hunttr.com" />
<meta name="Copyright" content=" Hunttr" />
<meta name="language" content="English" />
<meta name="ROBOTS" content="INDEX, FOLLOW" />
<meta name="Robots" content="INDEX, ALL" />
<meta name="YahooSeeker" content="INDEX, FOLLOW" />
<meta name="msnbot" content="INDEX, FOLLOW" />
<meta name="googlebot" content="INDEX, FOLLOW" />
<meta name="allow-search" content="yes" />
<meta name="revisit-after" content="daily" />
<meta name="Rating" content="General" />
<meta name="distribution" content="global" />
<meta name="page-topic" content="Hunttr Dating app” />
<meta name="services" content="Find love & companionship on Hunttr, India's most trusted dating app! Connect with genuine profiles, enjoy secure chats, and spark meaningful connections. Join now!"/>
<meta name="site" content="Hunttr - India's Trusted Dating App | Find Love!" />
<h1 style='display: none;'>Hunttr Dating app</h1>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- site favicon -->
	<link rel="icon" type="image/png" href="{{asset('front/assets/images/hunt.png')}}"> 
    <meta name="csrf-token" content="Ls6w_i3g_k1pAQOSOm6rMRFVpt5FxxiC8wbWAxrWtMc" /> 

	{{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}

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

    <!--<div class="preloader">-->
    <!--    <div class="preloader-inner">-->
    <!--        <div class="preloader-icon">-->
    <!--            <span></span>-->
    <!--            <span></span>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->

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
	<!-- Google tag (gtag.js) --> 
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-TSC7SX3J6D"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-TSC7SX3J6D'); </script>

    @yield('extra_js')
</body>