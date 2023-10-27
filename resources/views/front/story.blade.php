@extends('front.layout.app')
@section('extra_css')
<style>
    .blog__image {
  width: 200%;
  height: 300px; /* Adjust the height as per your requirements */
  object-fit: cover; /* Maintain aspect ratio and fill the container */
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
                @foreach ($storyget as $item)
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="blog__item">
                            <div class="blog__inner">
                                <div class="blog__thumb">
                                    <img src="{{url('public'.$item->story_image)}}" alt="Dating tips" class="blog__image">
                                </div>
                                <div class="blog__content px-3 py-4">
                                    <a href="{{ route('landing.story_details_page', ['id' => $item->id]) }}"><h3>{{$item->title}}</h3></a>
                                    <div class="blog__metapost">
                                        <a href="#">Admin</a>
                                        <a href="#">{{$item->created_at->format('d-m-Y')}}</a>
                                    </div>
                                    {{-- <p class="blog__description">{!! Str::limit($item->story_description, 30) !!}</p>
                                    <a href="{{ route('landing.story_details_page', ['id' => $item->id]) }}" class="default-btn"><span>Read More</span></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- ================> Blog section end here <================== -->
    
@endsection

@section('extra_js')
<script>
    
</script>
@endsection