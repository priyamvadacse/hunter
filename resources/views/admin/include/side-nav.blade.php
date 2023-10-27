<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{route('admin.dashboard')}}"><img src="{{asset('assets/images/logo.png')}}" width="90" alt="Online Dating App In India"><span class="m-l-10"></span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    {{-- <img src="{{url(Auth::guard('admin')->user()->image)}}" alt="Best Free Online Dating App In India" width="60px;"> --}}
                    <div class="detail">

                        <a href="{{route('admin.profile')}}"><h4>Edit Profile</h4></a>
                        
                    </div>
                </div>
            </li>

            @if($user->role == 'Super Admin' || $user->permissions[0]->permission == 1)
            <li class="active open"><a href="{{route('admin.dashboard')}}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
            </li>
            @endi
            @if($user->role == 'Super Admin' || $user->permissions[1]->permission == 1)
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Users</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('admin.user')}}">Add Users</a></li>
                    <li><a href="{{route('admin.active_user.list')}}">Active Users</a></li>
                    <li><a href="{{route('admin.inactive_user.list')}}">Inactive Users</a></li>
                    <li><a href="{{route('admin.user.list')}}">User list</a></li>
                    <li><a href="{{route('admin.paiduserlist')}}">Paid User List</a></li>
                    <li><a href="{{route('admin.unpaiduserlist')}}">Unpaid User List</a></li>
                </ul>
            </li>
            @endif

            @if($user->role == 'Super Admin' || $user->permissions[2]->permission == 1)
            <li> <a href="{{route('admin.package')}}" class=""><i class="zmdi zmdi-blogger"></i><span>Package</span></a>
                <ul class="ml-menu">
                    
                </ul>
            </li>
            @endif

            @if($user->role == 'Super Admin' || $user->permissions[3]->permission == 1)
            <li> <a href="{{route('admin.offer')}}" class=""><i class="zmdi zmdi-blogger"></i><span>Offers</span></a>
                <ul class="ml-menu">
                   
                </ul>
            </li>
            @endif

            @if($user->role == 'Super Admin' || $user->permissions[4]->permission == 1)
            <li> <a href="{{route('admin.boost.index_page')}}" class=""><i class="zmdi zmdi-blogger"></i><span>Boost Package</span></a>
                <ul class="ml-menu">
                   
                </ul>
            </li>
            @endif

            @if($user->role == 'Super Admin' || $user->permissions[5]->permission == 1)
            <li> <a href="{{route('admin.story_index')}}" class=""><i class="zmdi zmdi-blogger"></i><span>Story</span></a>
            </li>
            @endif

            @if($user->role == 'Super Admin' || $user->permissions[6]->permission == 1)
            <li> <a href="#" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span>KYC</span></a>
                <ul class="ml-menu">
                  
                    <li><a href="{{route('admin.kycverifiedlist')}}">Verified</a></li> 
                    <li><a href="{{route('admin.kycUnverifiedlist')}}">unverified</a></li> 
                   
                </ul>
            </li>
            @endif

            @if($user->role == 'Super Admin' || $user->permissions[7]->permission == 1)
            <li> <a href="#" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span> Payment</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('admin.payment')}}">All</a></li>
                   
                </ul>
            </li>
            @endif
            


            
            @if($user->role == 'Super Admin' || $user->permissions[8]->permission == 1)
            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-flower"></i><span>CMS</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('admin.about_us')}}">About Us</a></li>
                    <li><a href="{{route('admin.Privacypolicy')}}">Privacy Policy</a></li>
                    <li><a href="{{route('admin.contact')}}">Contact US</a></li>
                    <li><a href="{{route('admin.termcondition')}}">Term Condition</a></li>
                    <li><a href="{{route('admin.cookiepolicy')}}">Cookie Policy</a></li>
                    <li><a href="{{route('admin.faqpage')}}">FAQ</a></li>
                    <li><a href="{{route('admin.social_media_page')}}">Social Media</a></li>

                </ul>
            </li>
            @endif
           
            @if($user->role == 'Super Admin' || $user->permissions[9]->permission == 1)
            <li> <a href="{{route('admin.profilepage')}}" class=""><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                <ul class="ml-menu">
                   
                </ul>
            </li>
            @endif

            @if($user->role == 'Super Admin' || $user->permissions[10]->permission == 1)
                <li> <a href="{{route('admin.ajax_employee')}}" class=""><i class="zmdi zmdi-account"></i><span> Manage Employee</span></a>

                <ul class="ml-menu">
                    
                </ul>
            </li>
            @endif

            
        </ul>
    </div>
</aside>





