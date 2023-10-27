@extends('front.layout.app')
@section('extra_css')
    
@endsection
@section('content')
 
    <div class="banner banner--style2 padding-top bg_img"
        style="background-image: url({{ asset('front/assets/images/banner/bg-2.jpg') }})">
        <div class="container">
            <div class="banner__wrapper">
                <div class="row g-0 justify-content-center">
                    <div class="col-lg-4 col-12">
                        <div class="banner__content wow fadeInLeft" data-wow-duration="1.5s">
                            <div class="banner__title">
                                <h2>New Places, Unforgettable Dating.</h2>
                                <p>Join our international family today! Please call us for more info.</p>
                                <!-- <a href="membership.html" class="default-btn style-2"><span>Get A Membership</span></a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="banner__thumb wow fadeInUp" data-wow-duration="1.5s">
                            <img src="{{ asset('front/assets/images/banner/02.png') }}" alt="Online dating India">
                            <div class="banner__thumb--shape">
                                <div class="shapeimg shapeimg__one">
                                    <img src="{{ asset('front/assets/images/banner/shape/home2/01.png') }}"
                                        alt="dating app">
                                </div>
                                <div class="shapeimg shapeimg__two">
                                    <img src="{{ asset('front/assets/images/banner/shape/home2/02.png') }}"
                                        alt="Dating site">
                                </div>
                                <div class="shapeimg shapeimg__three">
                                    <img src="{{ asset('front/assets/images/banner/shape/home2/03.png') }}"
                                        alt="Relationships">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="about about--style2 ">
        <div class="container">
            <div class="section__wrapper wow fadeInUp" data-wow-duration="1.5s">
                <div class="row ">
                    <div class="col">
                        <div class="about__left">
                            <div class="about__top">
                                <div class="about__content">
                                    <h2 class="text-center">Welcome To Our Hunttr</h2>
                                    <p>You find us, finally, and you are already in love. More than 4.000.000 around the
                                        world already shared the same experiences and uses our system. Joining us today just
                                        got easier!</p>
                                </div>
                            </div>
                            <div class="about__bottom">
                                <div class="about__bottom--head">
                                    <h5>Latest Registered Members</h5>
                                    <div class="about__bottom--navi">
                                        <div class="ragi-prev"><i class="fa-solid fa-chevron-left"></i></div>
                                        <div class="ragi-next active"><i class="fa-solid fa-chevron-right"></i></div>
                                    </div>
                                </div>
                                <div class="about__bottom--body">
                                    <div class="ragi__slider overflow-hidden">
                                        <div class="swiper-wrapper">
                                            
                                                
                                            @foreach ($userpic as $key=>$user_img)                                            
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#">
                                                        <img src="{{ url($user_img->pic1 ? 'public'. $user_img->pic1 : 'public/front/assets/images/ragi/dummy-man.png') }}" style="width: 100px;
                                                        height: 100px;">

                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach
                                            
                                            {{-- <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('front/assets/images/ragi/reg2.png') }}"
                                                            alt="dating thumb"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('front/assets/images/ragi/reg3.png') }}"
                                                            alt="dating thumb"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('front/assets/images/ragi/reg4.png') }}"
                                                            alt="dating thumb"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('front/assets/images/ragi/reg5.png') }}"
                                                            alt="dating thumb"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('front/assets/images/ragi/rag1.png') }}"
                                                            alt="dating thumb"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('front/assets/images/ragi/reg2.png') }}"
                                                            alt="dating thumb"></a>
                                                </div>/
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('front/assets/images/ragi/reg3.png') }}"
                                                            alt="dating thumb"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="#"><img
                                                            src="{{ asset('front/assets/images/ragi/reg4.png') }}"
                                                            alt="dating thumb"></a>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="about padding-top padding-bottom">
        <div class="container">
            <div class="section__header style-2 text-center wow fadeInUp" data-wow-duration="1.5s">
                <h2>It All Starts With A Date</h2>
                <p>Begin your journey with Hunttr! Explore connections, friendships, and love through meaningful dates. Join us today and start something special.</p>
            </div>
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1">
                    <div class="col wow fadeInUp" data-wow-duration="1.5s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('front/assets/images/about/icon/01.png') }}" alt="Love and romance">
                                </div>
                                <div class="about__content">
                                    <h3><span class="counter" data-to="{{$total}}" data-speed="1500"></span></h3>
                                    <p>Members in Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col wow fadeInUp" data-wow-duration="1.6s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('front/assets/images/about/icon/02.png') }}" alt="dating thumb">
                                </div>
                                <div class="about__content">
                                    <h3><span class="counter" data-to="628590" data-speed="1500"></span></h3>
                                    <p>Members Online</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col wow fadeInUp" data-wow-duration="1.7s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('front/assets/images/about/icon/03.png') }}" alt="Meet singles">
                                </div>
                                <div class="about__content">
                                    <h3><span class="counter" data-to="{{$totalwoman}}" data-speed="1500"></span></h3>
                                    <p>Women In Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.8s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('front/assets/images/about/icon/04.png') }}" alt="Matchmaking app">
                                </div>
                                <div class="about__content">
                                    <h3><span class="counter" data-to="{{$totalman}}" data-speed="1500"></span></h3>
                                    <p>Men In Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================> Story section start here <================== -->
    <div class="story bg_img padding-top padding-bottom"
        style="background-image:url({{ url('front/assets/images/bg-img/02.jpg') }});">
        <div class="container">
            <div class="section__header style-2 text-center wow fadeInUp" data-wow-duration="1.5s">
                <h2>Hunttr Stories From Our Lovers</h2>
                <p>Listen and learn from our community members and find out tips and tricks to meet your love. Join us and
                    be part of a bigger family.</p>
            </div>
            <div class="section__wrapper">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($storyget as $item)
                            <div class="swiper-slide">
                                <div class="col wow fadeInUp" data-wow-duration="1.6s">
                                    <div class="story__item">
                                        <div class="story__inner">
                                            <div class="story__thumb">
                                                <a href="#">
                                                    <img src="{{ url('public'.$item->story_image) }}" alt="Chat and flirt"
                                                        style="width: 400px; height: 310px;">
                                                </a>
                                                {{-- <span class="member__activity member__activity--ofline">Love Stories</span> --}}
                                            </div>
                                            <div class="story__content">
                                                <a href="{{ route('landing.story_details_page', ['id' => $item->id]) }}">
                                                    <h4>{{ $item->title }}</h4>
                                                </a>
                                                <div class="story__content--author">
                                                    {{-- <div class="story__content--thumb">
										<img src="{{ asset('front/assets/images/story/author/user2.png') }}" alt="dating thumb">
									</div> --}}
                                                    <div class="story__content--content">
                                                        {{-- <h6>Admin</h6> --}}
                                                        <p>{{ $item->created_at->format('d-m-Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="swiper-slide">
                            <div class="col wow fadeInUp" data-wow-duration="1.5s">
                                <div class="story__item">
                                    <div class="story__inner">
                                        <div class="story__thumb">
                                            <a href="#"><img src="{{ asset('front/assets/images/story/cp1.png') }}"
                                                    alt="dating thumb"></a>
                                            <span class="member__activity member__activity--ofline">Entertainment</span>
                                        </div>
                                        <div class="story__content">
                                            <a href="#">
                                                <h4>Dream places and locations to visit in 2022</h4>
                                            </a>
                                            <div class="story__content--author">
                                                <div class="story__content--thumb">
                                                    <img src="{{ asset('front/assets/images/story/author/user1.png') }}"
                                                        alt="dating thumb">
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
                        </div> --}}

                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> Story section end here <================== -->

    <!-- ================> About section start here <================== -->
    <div class="about padding-top padding-bottom bg_img"
        style="background-image: url({{ url('front/assets/images/bg-img/02.jpg') }});">
        <div class="container">
            <div class="section__header style-2 text-center wow fadeInUp" data-wow-duration="1.5s">
                <h2>Why Choose Hunttr</h2>
                <p>Our dating platform is like a breath of fresh air. Clean and trendy design with ready to use features we
                    are sure you will love.</p>
            </div>
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1"
                    id="swiper-container">
                    <div class="col wow fadeInUp" data-wow-duration="1.5s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('front/assets/images/about/01.jpg') }}" alt="Dating platform">
                                </div>
                                <div class="about__content">
                                    <h4>Simple To Use</h4>
                                    <p>Simple steps to follow to have a matching connection.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.6s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('front/assets/images/about/02.jpg') }}" alt="Dating services">
                                </div>
                                <div class="about__content">
                                    <h4>Smart Matching</h4>
                                    <p>Create connections with users that are like you.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.7s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('front/assets/images/about/03.jpg') }}" alt="Singles near me">
                                </div>
                                <div class="about__content">
                                    <h4>Filter Very Fast</h4>
                                    <p>Don’t waste your time! Find only what you are interested</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col wow fadeInUp" data-wow-duration="1.8s">
                        <div class="about__item text-center">
                            <div class="about__inner">
                                <div class="about__thumb">
                                    <img src="{{ asset('front/assets/images/about/04.jpg') }}" alt="Indian matchmaking">
                                </div>
                                <div class="about__content">
                                    <h4>Cool Community</h4>
                                    <p>Join Hunttr: Where Connections Thrive!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> About section end here <================== -->

    <!-- ================> Work section start here <================== -->
    <div class="work work--style2 padding-top padding-bottom bg_img"
        style="background-image: url({{ url('assets/images/bg-img/01.jpg') }});">
        <div class="container">
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center">
                    <div class="col-xl-6 col-lg-8 col-12 wow fadeInLeft" data-wow-duration="1.5s">
                        <div class="work__item">
                            <div class="work__inner">
                                <div class="work__thumb">
                                    <img src="{{ asset('front/assets/images/work/09.png') }}" alt="Dating app for Android/iOS">
                                </div>
                                <div class="work__content">
                                    <h3>Trust And Safety</h3>
                                    <p>Choose from one of our membership levels and unlock features you need. </p>
                                    {{-- <a href="policy.html" class="default-btn"><span>See More Details</span></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-8 col-12 wow fadeInRight" data-wow-duration="1.5s">
                        <div class="work__item">
                            <div class="work__inner">
                                <div class="work__thumb">
                                    <img src="{{ asset('front/assets/images/work/10.png') }}" alt="Casual dating">
                                </div>
                                <div class="work__content">
                                    <h3>Simple Membership</h3>
                                    <p>Choose from one of our membership levels and unlock features you need. </p>
                                    {{-- <a href="membership.html" class="default-btn reverse"><span>Membership Details</span></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> Work section end here <================== -->

    <!-- ================> App section start here <================== -->
    <div class="app app--style2 padding-top padding-bottom">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-xxl-6 col-12">
                    <div class="app__item wow fadeInUp" data-wow-duration="1.5s">
                        <div class="app__inner">
                            <div class="app__content text-center">
                                <h4>Download App Hunttr</h4>
                                <h2>Easy Connect To Everyone</h2>
                                <p>Get Hunttr App: Effortlessly connect with everyone! Explore meaningful connections and grow your social circle. Join now!</p>
                                <ul class="justify-content-center">
                                    <li><a href="#" target="_blank"><img src="{{ asset('front/assets/images/app/01.jpg') }}"
                                                alt="Serious relationships"></a></li>
                                    <li><a href="https://play.google.com/store/apps/details?id=com.hunterr" target="_blank"><img src="{{ asset('front/assets/images/app/02.jpg') }}"
                                                alt="Dating in India"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> App section end here <================== -->
@endsection
@section('extra_js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper', {
            slidesPerView: 3,
            rewind: true,
            direction: getDirection(),
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            on: {
                resize: function() {
                    swiper.changeDirection(getDirection());
                },
            },
        });

        function getDirection() {
            var windowWidth = window.innerWidth;
            var direction = window.innerWidth <= 360 ? 'vertical' : 'horizontal';

            return direction;
        }
    </script>
@endsection
