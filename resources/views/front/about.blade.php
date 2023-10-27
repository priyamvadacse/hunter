@extends('front.layout.app')

@section('content')

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

<div class="pageheader bg_img" style="background-image: url({{asset('front/assets/images/bg-img/pageheader.jpg);')}}">
    <div class="container">
        <div class="pageheader__content text-center">
            @if(!empty($about_us))
            <h2>{{$about_us->title}}</h2>
            @else
            <h2>About Us</h2>
            @endif
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                  <li ><a href="{{route('landing.page')}}">Home</a></li>
                  <!-- <li ><a href="#">Page</a></li> -->/
                  <li style="color: #E50E47;" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
 <!-- ================> About section start here <================== -->
 <div class="about about--style5 padding-top padding-bottom">
    <div class="container">
        <div class="row justify-content-center g-4 align-items-center">
            <div class="col-lg-6 col-12">
                <div class="about__thumb">
                    <img src="{{asset('front/assets/images/about/01.png')}}" alt="Dating profiles">
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="about__content">
                   @if(!empty($about_us))
                    <p>{!!$about_us->content!!}</p>
                    @else
                    <p></p>
                    @endif
                    <!-- <a href="membership.html" class="default-btn reverse"><span>Get A Membership</span></a> -->
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="about padding-top padding-bottom bg_img" style="background-image: url(assets/images/bg-img/02.jpg);">
    <div class="container">
        <div class="section__header style-2 text-center">
            <h2>Why Choose Hunttr</h2>
            <p>Our dating platform is like a breath of fresh air. Clean and trendy design with ready to use features we are sure you will love.</p>
        </div>
        <div class="section__wrapper">
            <div class="row g-4 justify-content-center row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1">
                <div class="col">
                    <div class="about__item text-center">
                        <div class="about__inner">
                            <div class="about__thumb">
                                <img src="{{asset('front/assets/images/about/01.jpg')}}" alt="dating thumb">
                            </div>
                            <div class="about__content">
                                <h4>Simple To Use</h4>
                                <p>Simple steps to follow to have a matching connection.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="about__item text-center">
                        <div class="about__inner">
                            <div class="about__thumb">
                                <img src="{{asset('front/assets/images/about/02.jpg')}}" alt="dating thumb">
                            </div>
                            <div class="about__content">
                                <h4>Smart Matching</h4>
                                <p>Create connections with users that are like you.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="about__item text-center">
                        <div class="about__inner">
                            <div class="about__thumb">
                                <img src="{{asset('front/assets/images/about/03.jpg')}}" alt="dating thumb">
                            </div>
                            <div class="about__content">
                                <h4>Filter Very Fast</h4>
                                <p>Don’t waste your time! Find only what you are interested</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="about__item text-center">
                        <div class="about__inner">
                            <div class="about__thumb">
                                <img src="{{asset('front/assets/images/about/04.jpg')}}" alt="dating thumb">
                            </div>
                            <div class="about__content">
                                <h4>Cool Community</h4>
                                <p>BuddyPress network is full of cool members.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- ================> About section end here <================== -->


<!-- ================> Story section start here <================== -->
{{-- <div class="story bg_img padding-top padding-bottom" style="background-image: url({{asset('front/assets/images/bg-img/02.jpg);')}}">
    <div class="container">
        <div class="section__header style-2 text-center wow fadeInUp" data-wow-duration="1.5s">
            <h2>Hunttr Stories From Our Lovers</h2>
            <p>Listen and learn from our community members and find out tips and tricks to meet your love. Join us and be part of a bigger family.</p>
        </div>
        <div class="section__wrapper">
            <div class="row g-4 justify-content-center row-cols-lg-3 row-cols-sm-2 row-cols-1">
                <div class="col wow fadeInUp" data-wow-duration="1.5s">
                    <div class="story__item">
                        <div class="story__inner">
                            <div class="story__thumb">
                                <a href="blog.html"><img src="{{asset('front/assets/images/story/cp1.png')}}" alt="dating thumb"></a>
                                <span class="member__activity member__activity--ofline">Entertainment</span>
                            </div>
                            <div class="story__content">
                                <a href="blog.html"><h4>Dream places and locations to visit in 2022</h4></a>
                                <div class="story__content--author">
                                    <div class="story__content--thumb">
                                        <img src="{{asset('front/assets/images/story/author/user1.png')}}" alt="dating thumb">
                                    </div>
                                    <div class="story__content--content">
                                        <h6>Rohit Sharma</h6>
                                        <p>April 16, 2022</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col wow fadeInUp" data-wow-duration="1.6s">
                    <div class="story__item">
                        <div class="story__inner">
                            <div class="story__thumb">
                                <a href="blog.html"><img src="{{asset('front/assets/images/story/cop2.png')}}" alt="dating thumb"></a>
                                <span class="member__activity member__activity--ofline">Love Stories</span>
                            </div>
                            <div class="story__content">
                                <a href="blog.html"><h4>Make your dreams come true and monetise quickly</h4></a>
                                <div class="story__content--author">
                                    <div class="story__content--thumb">
                                        <img src="{{asset('front/assets/images/story/author/user2.png')}}" alt="dating thumb">
                                    </div>
                                    <div class="story__content--content">
                                        <h6>Anjali Gupta</h6>
                                        <p>March 14, 2022</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col wow fadeInUp" data-wow-duration="1.7s">
                    <div class="story__item">
                        <div class="story__inner">
                            <div class="story__thumb">
                                <a href="blog.html"><img src="{{asset('front/assets/images/story/cop3.png')}}" alt="dating thumb"></a>
                                <span class="member__activity member__activity--ofline">Attraction</span>
                            </div>
                            <div class="story__content">
                                <a href="blog.html"><h4>Love looks not with the eyes, but with the mind.</h4></a>
                                <div class="story__content--author">
                                    <div class="story__content--thumb">
                                        <img src="{{asset('front/assets/images/story/author/user3.png')}}" alt="dating thumb">
                                    </div>
                                    <div class="story__content--content">
                                        <h6>Riya </h6>
                                        <p>June 18, 2022</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- ================> Story section end here <================== -->


<!-- ================> Work section start here <================== -->
{{-- <div class="work work--style2 padding-top padding-bottom bg_img" style="background-image: url({{asset('front/assets/images/bg-img/01.jpg);')}}">
    <div class="container">
        <div class="section__wrapper">
            <div class="row g-4 justify-content-center">
                <div class="col-xl-6 col-lg-8 col-12">
                    <div class="work__item">
                        <div class="work__inner">
                            <div class="work__thumb">
                                <img src="{{asset('front/assets/images/work/09.png')}}" alt="dating thumb">
                            </div>
                            <div class="work__content">
                                <h3>Trust And Safety</h3>
                                <p>Choose from one of our membership levels and unlock features you need. </p>
                                <a href="policy.html" class="default-btn"><span>See More Details</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8 col-12">
                    <div class="work__item">
                        <div class="work__inner">
                            <div class="work__thumb">
                                <img src="{{asset('front/assets/images/work/10.png')}}" alt="dating thumb">
                            </div>
                            <div class="work__content">
                                <h3>Simple Membership</h3>
                                <p>Choose from one of our membership levels and unlock features you need. </p>
                                <a href="membership.html" class="default-btn reverse"><span>Membership Details</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- ================> Work section end here <================== -->


<!-- ================> App section start here <================== -->
{{-- <div class="app app--style2 padding-top padding-bottom">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-xxl-6 col-12">
                <div class="app__item">
                    <div class="app__inner">
                        <div class="app__content text-center">
                            <h4>Download App Hunttr</h4>
                            <h2>Easy Connect To Everyone</h2>
                            <p>You find us, finally and you are already in love. More than 5.000.000 around the world already shared the same experience andng ares uses our system Joining us today just got easier!</p>
                            <ul class="justify-content-center">
                                <li><a href="#"><img src="{{asset('front/assets/images/app/01.jpg')}}" alt="dating thumb"></a></li>
                                <li><a href="#"><img src="{{asset('front/assets/images/app/02.jpg')}}" alt="dating thumb"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- ================> App section end here <================== -->
    
@endsection