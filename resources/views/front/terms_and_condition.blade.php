@extends('front.layout.app')

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

<div class="pageheader bg_img" style="background-image: url({{asset('front/assets/images/bg-img/pageheader.jpg);')}}">
    <div class="container">
        <div class="pageheader__content text-center">
            <h2>Terms And Condition</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                  <li ><a href="{{route('landing.page')}}">Home</a></li>/
                  <li aria-current="page" style="color: #E50E47;">Terms and Condition </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- ===========Info Section Ends Here========== -->
<div class="info-section padding-top padding-bottom">
    <div class="container">
        {{-- <div class="section__header style-2 text-center">
            <h2>{{$privacy_policy->title}}</h2>
            
        </div> --}}
        <div class="section-wrapper">
            <div class="row justify-content-center g-4">
                @if($termConditions)
                <p>
                    {!! $termConditions->termcondition !!}
                </p>               
                @else
                <p></p>
                @endif
                
            </div>
        </div>
    </div>
</div>

<!-- ================> Footer section start here <================== -->
    
    
@endsection

