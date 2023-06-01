<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{route('admin.dashboard')}}"><img src="{{asset('assets/images/logo.svg')}}" width="25" alt="Aero"><span class="m-l-10"></span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <img src="{{url(Auth::guard('admin')->user()->image)}}" alt="User" width="60px;">
                    <div class="detail">

                        <a href="{{route('admin.profile')}}"><h4>Admin</h4></a>
                        {{-- <small>Super Admin</small> --}}
                    </div>
                </div>
            </li>
            <li class="active open"><a href="{{route('admin.dashboard')}}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Users</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('admin.user')}}">Add Users</a></li>
                    <li><a href="{{route('admin.active_user.list')}}">Active Users</a></li>
                    <li><a href="{{route('admin.inactive_user.list')}}">Inactive Users</a></li>
                    {{-- <li><a href="{{route('admin.verified_user.list')}}">Verified Users</a></li> --}}
                    <li><a href="{{route('admin.user.list')}}">User list</a></li>
                    <li><a href="{{route('admin.paiduserlist')}}">Paid User List</a></li>
                    <li><a href="{{route('admin.unpaiduserlist')}}">Unpaid User List</a></li>


                </ul>
            </li>
            {{-- <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Flagged Users</span></a>
                <ul class="ml-menu">
                    <li><a href="#">Total Flagged Users</a></li>
                    <li><a href="#">Total Blocked Users</a></li>
                      <li><a href="project-list.html">Projects List</a></li>
                    <li><a href="taskboard.html">Taskboard</a></li>
                    <li><a href="ticket-list.html">Ticket List</a></li>
                    <li><a href="ticket-detail.html">Ticket Detail</a></li> 
                </ul>
            </li> --}}

            <li> <a href="{{route('admin.package')}}" class=""><i class="zmdi zmdi-blogger"></i><span>Package</span></a>
                <ul class="ml-menu">
                    {{-- <li><a href="{{route('admin.package')}}">Add Package</a></li> --}}
                    {{-- <li><a href="{{route('admin.list.details')}}">Add Package Details</a></li> --}}
                    {{-- <li><a href="blog-list.html">List View</a></li> --}}
                    {{-- <li><a href="blog-grid.html">Grid View</a></li> --}}
                    {{-- <li><a href="blog-details.html">Blog Details</a></li> --}}
                </ul>
            </li>
            <li> <a href="{{route('admin.offer')}}" class=""><i class="zmdi zmdi-blogger"></i><span>Offers</span></a>
                <ul class="ml-menu">
                    {{-- <li><a href="{{route('admin.package')}}">Add Package</a></li> --}}
                    {{-- <li><a href="{{route('admin.list.details')}}">Add Package Details</a></li> --}}
                    {{-- <li><a href="blog-list.html">List View</a></li> --}}
                    {{-- <li><a href="blog-grid.html">Grid View</a></li> --}}
                    {{-- <li><a href="blog-details.html">Blog Details</a></li> --}}
                </ul>
            </li>

            <li> <a href="#" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span>KYC</span></a>
                <ul class="ml-menu">
                    {{-- <li><a href="#">Document</a></li> --}}
                    <li><a href="{{route('admin.kycverifiedlist')}}">Verified</a></li> 
                    <li><a href="{{route('admin.kycUnverifiedlist')}}">unverified</a></li> 
                    {{-- <li><a href="blog-list.html">List View</a></li> --}}
                    {{-- <li><a href="blog-grid.html">Grid View</a></li> --}}
                    {{-- <li><a href="blog-details.html">Blog Details</a></li> --}}
                </ul>
            </li>


            <li> <a href="#" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span> Payment</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('admin.payment')}}">All</a></li>
                    {{-- <li><a href="{{route('admin.pendinglist')}}">Pending List</a></li>  --}}
                    {{-- <li><a href="blog-list.html">List View</a></li> --}}
                    {{-- <li><a href="blog-grid.html">Grid View</a></li> --}}
                    {{-- <li><a href="blog-details.html">Blog Details</a></li> --}}
                </ul>
            </li>
            


            
            {{-- <li> <a href="#" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span>Report</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('admin.package')}}">Payment List</a></li>
                     <li><a href="{{route('admin.list.details')}}">Add Package Details</a></li>
                     <li><a href="blog-list.html">List View</a></li>
                     <li><a href="blog-grid.html">Grid View</a></li>
                     <li><a href="blog-details.html">Blog Details</a></li>
                </ul>
            </li> --}}

            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-flower"></i><span>CMS</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('admin.about_us')}}">About Us</a></li>
                    <li><a href="{{route('admin.Privacypolicy')}}">Privacy Policy</a></li>
                    <li><a href="{{route('admin.contact')}}">Contact US</a></li>
                    <li><a href="{{route('admin.termcondition')}}">Term Condition</a></li>
                    <li><a href="{{route('admin.cookiepolicy')}}">Cookie Policy</a></li>
                    <li><a href="{{route('admin.faqpage')}}">FAQ</a></li>

                </ul>
            </li>
            <li> <a href="{{route('admin.profilepage')}}" class=""><i class="zmdi zmdi-account"></i><span>Admin Profile</span></a>
                <ul class="ml-menu">
                    {{-- <li><a href="{{route('admin.profile')}}">Edit Profile</a></li> --}}
                    {{-- <li><a href="{{route('admin.contact')}}">Contact US</a></li> --}}
                    {{-- <li><a href="file-images.html">Images</a></li> --}}
                    {{-- <li><a href="file-media.html">Media</a></li> --}}
                </ul>
            </li>
            {{-- <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span>Blog</span></a>
                <ul class="ml-menu">
                    <li><a href="blog-dashboard.html">Dashboard</a></li>
                    <li><a href="blog-post.html">Blog Post</a></li>
                    <li><a href="blog-list.html">List View</a></li>
                    <li><a href="blog-grid.html">Grid View</a></li>
                    <li><a href="blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shopping-cart"></i><span>Ecommerce</span></a>
                <ul class="ml-menu">
                    <li><a href="ec-dashboard.html">Dashboard</a></li>
                    <li><a href="ec-product.html">Product</a></li>
                    <li><a href="ec-product-List.html">Product List</a></li>
                    <li><a href="ec-product-detail.html">Product detail</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-swap-alt"></i><span>Components</span></a>
                <ul class="ml-menu">
                    <li><a href="ui_kit.html">Aero UI KIT</a></li>
                    <li><a href="alerts.html">Alerts</a></li>
                    <li><a href="collapse.html">Collapse</a></li>
                    <li><a href="colors.html">Colors</a></li>
                    <li><a href="dialogs.html">Dialogs</a></li>
                    <li><a href="list-group.html">List Group</a></li>
                    <li><a href="media-object.html">Media Object</a></li>
                    <li><a href="modals.html">Modals</a></li>
                    <li><a href="notifications.html">Notifications</a></li>
                    <li><a href="progressbars.html">Progress Bars</a></li>
                    <li><a href="range-sliders.html">Range Sliders</a></li>
                    <li><a href="sortable-nestable.html">Sortable & Nestable</a></li>
                    <li><a href="tabs.html">Tabs</a></li>
                    <li><a href="waves.html">Waves</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-flower"></i><span>Font Icons</span></a>
                <ul class="ml-menu">
                    <li><a href="icons.html">Material Icons</a></li>
                    <li><a href="icons-themify.html">Themify Icons</a></li>
                    <li><a href="icons-weather.html">Weather Icons</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Forms</span></a>
                <ul class="ml-menu">
                    <li><a href="basic-form-elements.html">Basic Form</a></li>
                    <li><a href="advanced-form-elements.html">Advanced Form</a></li>
                    <li><a href="form-examples.html">Form Examples</a></li>
                    <li><a href="form-validation.html">Form Validation</a></li>
                    <li><a href="form-wizard.html">Form Wizard</a></li>
                    <li><a href="form-editors.html">Editors</a></li>
                    <li><a href="form-upload.html">File Upload</a></li>
                    <li><a href="form-summernote.html">Summernote</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-grid"></i><span>Tables</span></a>
                <ul class="ml-menu">
                    <li><a href="normal-tables.html">Normal Tables</a></li>
                    <li><a href="jquery-datatable.html">Jquery Datatables</a></li>
                    <li><a href="editable-table.html">Editable Tables</a></li>
                    <li><a href="footable.html">Foo Tables</a></li>
                    <li><a href="table-color.html">Tables Color</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-chart"></i><span>Charts</span></a>
                <ul class="ml-menu">
                    <li><a href="c3.html">C3 Chart</a></li>
                    <li><a href="morris.html">Morris</a></li>
                    <li><a href="flot.html">Flot</a></li>
                    <li><a href="chartjs.html">ChartJS</a></li>
                    <li><a href="sparkline.html">Sparkline</a></li>
                    <li><a href="jquery-knob.html">Jquery Knob</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-delicious"></i><span>Widgets</span></a>
                <ul class="ml-menu">
                    <li><a href="widgets-app.html">Apps Widgets</a></li>
                    <li><a href="widgets-data.html">Data Widgets</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-lock"></i><span>Authentication</span></a>
                <ul class="ml-menu">
                    <li><a href="sign-in.html">Sign In</a></li>
                    <li><a href="sign-up.html">Sign Up</a></li>
                    <li><a href="forgot-password.html">Forgot Password</a></li>
                    <li><a href="404.html">Page 404</a></li>
                    <li><a href="500.html">Page 500</a></li>
                    <li><a href="page-offline.html">Page Offline</a></li>
                    <li><a href="locked.html">Locked Screen</a></li>
                </ul>
            </li>
            <li class="open_top"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-copy"></i><span>Sample Pages</span></a>
                <ul class="ml-menu">
                    <li><a href="blank.html">Blank Page</a></li>
                    <li><a href="image-gallery.html">Image Gallery</a></li>
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="timeline.html">Timeline</a></li>
                    <li><a href="pricing.html">Pricing</a></li>
                    <li><a href="invoices.html">Invoices</a></li>
                    <li><a href="invoices-list.html">Invoices List</a></li>
                    <li><a href="search-results.html">Search Results</a></li>
                </ul>
            </li>
            <li class="open_top"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-map"></i><span>Maps</span></a>
                <ul class="ml-menu">
                    <li><a href="google.html">Google Map</a></li>
                    <li><a href="yandex.html">YandexMap</a></li>
                    <li><a href="jvectormap.html">jVectorMap</a></li>
                </ul>
            </li>
            <li>
                <div class="progress-container progress-primary m-t-10">
                    <span class="progress-badge">Traffic this Month</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%;">
                            <span class="progress-value">67%</span>
                        </div>
                    </div>
                </div>
                <div class="progress-container progress-info">
                    <span class="progress-badge">Server Load</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                            <span class="progress-value">86%</span>
                        </div>
                    </div>
                </div>
            </li> --}}
        </ul>
    </div>
</aside>
{{-- @section('extra_js')
    <script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>
@endsection --}}




