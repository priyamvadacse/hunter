@extends('front.layout.app')

@section('extra_css')
<style>
    .blog__image {
  width: 100%;
  max-width: 100%;
  height: auto;
  object-fit: cover;
}

</style>

@endsection

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

    <!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="fa-solid fa-angle-up"></i></a>
    <!-- scrollToTop ending here -->

    <!-- ================> Blog section start here <================== -->
    <div class="blog padding-top padding-bottom">
        <div class="container">
            <div class="section-wrapper">
                <div class="row g-4 justify-content-center">
                    <div class="col-12">
                        <div class="blog__thumb">
                            <img src="{{ url('public'.$getdetailsStory->story_image) }}" alt="Relationship advice" class="blog__image">
                        </div>
                        <div class="blog__item">
                            <div class="blog__inner d-flex flex-wrap align-items-center">
                                <div class="blog__content p-4 ps-xl-5 w-xl-50 w-100">
                                    <a href="#"><h3>{{ $getdetailsStory->title }}</h3></a>
                                    <div class="blog__metapost">
                                        <a href="#">Admin</a>
                                        <a href="#">{{ $getdetailsStory->created_at->format('d-m-Y') }}</a>
                                    </div>
                                    <p>{!! $getdetailsStory->story_description !!}</p>
                                    <!-- <a href="blog-single.html" class="default-btn"><span>read more</span></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('extra_js')
@endsection
