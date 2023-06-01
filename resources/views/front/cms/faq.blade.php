@extends('front.layout.app')

<style>
    .faq-section {
        background: #fdfdfd;
        min-height: 100vh;
        padding: 10vh 0 0;
    }

    .faq-title h2 {
        position: relative;
        margin-bottom: 45px;
        display: inline-block;
        font-weight: 600;
        line-height: 1;
    }

    .faq-title h2::before {
        content: "";
        position: absolute;
        left: 50%;
        width: 60px;
        height: 2px;
        background: #E91E63;
        bottom: -25px;
        margin-left: -30px;
    }

    .faq-title p {
        padding: 0 190px;
        margin-bottom: 10px;
    }

    .faq {
        background: #FFFFFF;
        box-shadow: 0 2px 48px 0 rgba(0, 0, 0, 0.06);
        border-radius: 4px;
    }

    .faq .card {
        border: none;
        background: none;
        border-bottom: 1px dashed #CEE1F8;
    }

    .faq .card .card-header {
        padding: 0px;
        border: none;
        background: none;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }

    .faq .card .card-header:hover {
        background: rgba(233, 30, 99, 0.1);
        padding-left: 10px;
    }

    .faq .card .card-header .faq-title {
        width: 100%;
        text-align: left;
        padding: 0px;
        padding-left: 30px;
        padding-right: 30px;
        font-weight: 400;
        font-size: 15px;
        letter-spacing: 1px;
        color: #3B566E;
        text-decoration: none !important;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        cursor: pointer;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .faq .card .card-header .faq-title .badge {
        display: inline-block;
        width: 20px;
        height: 20px;
        line-height: 14px;
        float: left;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
        text-align: center;
        background: #E91E63;
        color: #fff;
        font-size: 12px;
        margin-right: 20px;
    }

    .faq .card .card-body {
        padding: 30px;
        padding-left: 35px;
        padding-bottom: 16px;
        font-weight: 400;
        font-size: 16px;
        color: #6F8BA4;
        line-height: 28px;
        letter-spacing: 1px;
        border-top: 1px solid #F3F8FF;
    }

    .faq .card .card-body p {
        margin-bottom: 14px;
    }

    @media (max-width: 991px) {
        .faq {
            margin-bottom: 30px;
        }

        .faq .card .card-header .faq-title {
            line-height: 26px;
            margin-top: 10px;
        }
    }
</style>
@section('content')
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="fa-solid fa-angle-up"></i></a>
    <!-- scrollToTop ending here -->

    <div class="pageheader bg_img" style="background-image: url({{ asset('front/assets/images/bg-img/pageheader.jpg);') }}">
        <div class="container">
            <div class="pageheader__content text-center">
                <h2>FAQ</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li><a href="{{ route('landing.page') }}">Home</a></li>/
                        <li aria-current="page" style="color: #E50E47;">Faq</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="faq-section">
        <div class="container">
            <div class="row">
                <!-- ***** FAQ Start ***** -->
                <div class="col-md-8 offset-md-2">

                    <div class="faq-title text-center pb-3">
                        <h2>FAQ</h2>
                    </div>
                </div>
                <div class="col-md-8 offset-md-2">
                    
                    <div class="faq" id="accordion">
                        <div class="card">
                            @foreach ($faq as $key=> $item)
                            <div class="card-header" id="faqHeading">
                                <div class="mb-0">
                                    <h5 class="faq-title"  data-bs-toggle="collapse" data-bs-target="#faqCollapse-{{$item->id}} "
                                        data-aria-expanded="true" data-aria-controls="faqCollapse">
                                        <span class="badge">{{$key+1}}</span>{{$item->question}}?
                                    </h5>
                                </div>
                            </div>
                            <div id="faqCollapse-{{$item->id}}" class="collapse" aria-labelledby="faqHeading"
                                data-bs-parent="#accordion">
                                <div class="card-body" id="faqCollapse">
                                    <p>
                                        {!! $item->answer !!}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <!-- ===========Info Section Ends Here========== -->
<div class="info-section padding-top padding-bottom">
    <div class="container">
        <div class="section__header style-2 text-center">
            <h2>Frequently Asked Questions</h2>
            <p>Let us know your opinions. Also you can write us if you have any questions.</p>
        </div>
        <div class="section-wrapper">
            <div class="row justify-content-center g-4">
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card border-0 wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                        <div class="card-header" id="headingTwo">
                            <h6 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">The apps isn't installing?<span class="lni-chevron-up"></span></h6>
                        </div>
                        <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                            <div class="card-body">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quidem facere deserunt sint animi sapiente vitae suscipit.</p>
                                <p>Appland is completely creative, lightweight, clean &amp; super responsive app landing page.</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                
            </div>
        </div>
    </div>
</div> --}}
@endsection
