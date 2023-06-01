@extends('admin.layout.layouts')
@section('extra_css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.css') }}">
@endsection

@section('content')
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Main Search -->
    <div id="search">
        <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
        <form>
            <input type="search" value="" placeholder="Search..." />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>



    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Profile</h2>

                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary float-right right_icon_toggle_btn" type="button">Back</button>
                        <a href="{{ route('admin.profilesubmit') }}" class="btn btn-primary float-right">Edit</a>
                        <a href="{{ route('admin.changePassword') }}" class="btn btn-primary float-right ">Change Password</a>

                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12">
                        <div class="card mcard_3">
                            <div class="body">

                                <div class="user-info">
                                    <img src="{{ url(Auth::guard('admin')->user()->image) }}" alt="User"
                                        class="rounded-circle shadow" width="200px" height="200px">
                                    <div class="detail">


                                        <h5 class="mt-4">{{ Auth::guard('admin')->user()->name }}</h5>

                                        <h5>{{ Auth::guard('admin')->user()->email }}</h5>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="body">
                                <div id="calendar"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12">
                        
                    </div>



                        <div class="card mcard_3">

                        </div>
                                           </div>



                </div>
            </div>
        </div>
    </section>
@endsection


@section('extra_js')
    <script src="{{ asset('assets/bundles/fullcalendarscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/calendar/calendar.js') }}"></script>
@endsection
