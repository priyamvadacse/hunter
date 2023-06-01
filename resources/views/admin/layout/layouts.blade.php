<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="admin.">
<title> Hunttr | Admin Panel</title>

<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<!-- Custom Css -->
<link  rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/bundles/izitoast/css/iziToast.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-confirm/jquery-confirm.min.css')}}" />
@yield('extra_css')
</head>

<body class="theme-blush">
            <!-- include Navbar-->
            @include('admin.include.nav-bar')

            <!-- include sidebar-->
            @include('admin.include.side-nav')

            {{-- @include('admin.include.right-sidenav') --}}
            <!-- content--->
            <div class="main-content">
                @yield('content')
            </div>

  <!-- include footer-->


<!-- Jquery Core Js -->
<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('assets/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>

<script>
    function showSuccessMsg(text) {
        showNotification("alert-success", text, 'top', 'right', "", "");
    }

    function showErrorMsg(text) {
        showNotification("alert-danger", text, 'top', 'right', "", "");
    }

    function showNotification(colorName, text, placementFrom, placementAlign, animateEnter, animateExit) {
    if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInDown'; }
    if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutUp'; }
    var allowDismiss = true;

    $.notify({
        message: text
    },
        {
            type: colorName,
            allow_dismiss: allowDismiss,
            newest_on_top: true,
            timer: 100000,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            animate: {
                enter: animateEnter,
                exit: animateExit
            },
            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "" : "") + '" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
}
</script>
<script src="{{asset('assets/bundles/izitoast/js/iziToast.min.js')}}"></script>
<script src="{{asset('assets/bundles/jquery-confirm/jquery-confirm.min.js')}}"></script>
<script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
@yield('libraries')

<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js -->

@yield('extra_js')

</body>


</html>
