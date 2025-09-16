
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <!-- <meta name="author" content="flexilecode" /> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>@yield('page_title')</title>
    <!--! END:  Apps Title -->
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/assets/images/favicon.ico')}}" />
    <!--! END: Favicon-->
    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/bootstrap.min.css')}}" />
    <!--! END: Bootstrap CSS-->
    <!--! BEGIN: Vendors CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/vendors/css/vendors.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/vendors/css/daterangepicker.min.css')}}" />
    <!--! END: Vendors CSS-->
    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/theme.min.css')}}" />
    <!--! END: Custom CSS-->
     <!--! BEGIN: issue Table CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/vendors/css/dataTables.bs5.min.css')}}">
     <!--! End: Table CSS-->
    <!--! BEGIN: Table CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/bootstrap.min.css')}}">
    <!--! HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries !-->
    <!--! BEGIN:  Table CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/vendors/css/datepicker.min.css')}}">
    <!--! WARNING: Respond.js doesn"t work if you view the page via file: !-->
    <!--[if lt IE 9]>
			<script src="https:oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https:oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Navigation Manu !-->
    <!--! ================================================================ !-->
    @include('backend.sidebar')
    <!--! ================================================================ !-->
    <!--! [End]  Navigation Manu !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Header !-->
    <!--! ================================================================ !-->
    @include('backend.header')
    <!--! ================================================================ !-->
    <!--! [End] Header !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    @yield('content')
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Theme Customizer !-->
    <!--! ================================================================ !-->
    @include('backend.theme')
    <!--! ================================================================ !-->
    <!--! [End] Theme Customizer !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! Footer Script !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Vendors JS !-->
    <script src="{{asset('backend/assets/vendors/js/vendors.min.js')}}"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <script src="{{asset('backend/assets/vendors/js/daterangepicker.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/js/apexcharts.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/js/circle-progress.min.js')}}"></script>
    <!--! END: Vendors JS !-->
    <!--! BEGIN: Apps Init  !-->
    <script src="{{asset('backend/assets/js/common-init.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/dashboard-init.min.js')}}"></script>
    <!--! END: Apps Init !-->
    <!--! BEGIN: Theme Customizer  !-->
    <script src="{{asset('backend/assets/js/theme-customizer-init.min.js')}}"></script>
    <!--! END: Theme Customizer !-->
    <!--! BEGIN: Table   !-->
     <script src="{{asset('backend/assets/js/widgets-tables-init.min.js')}}"></script>
    <!--! END: Table   !-->
    <!--! BEGIN: Table   !-->
    <script src="{{asset('backend/assets/vendors/js/dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/js/dataTables.bs5.min.js')}}"></script>
    <!--! End: Table   !-->
    <!--! BEGIN: Date js   !-->
    <script src="{{asset('backend/assets/vendors/js/datepicker.min.js')}}"></script>
     <!--! print invoice   !-->
    <script src="{{asset('backend/assets/vendors/js/jquery.print.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/invoice-view-init.min.js')}}"></script>

</body>
</html>

<style>
    a {
        text-decoration: none !important;
    }
</style>

 <!-- Disable Copy/Paste all project -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Disable right-click
        // document.addEventListener('contextmenu', function (e) {
        //     e.preventDefault();
        // });

        // Disable copy
        // document.addEventListener('copy', function (e) {
        //     e.preventDefault();
        // });

        // Disable paste
        // document.addEventListener('paste', function (e) {
        //     e.preventDefault();
        // });

        // Disable text selection
        // document.addEventListener('selectstart', function (e) {
        //     e.preventDefault();
        // });
    });

</script>

<!-- disable page scrolling when the user holds down the Control (Ctrl) key -->
 <!-- Stop scroll/zoom when Ctrl is pressed -->
<script>
    document.addEventListener('wheel', function(event) {
        if (event.ctrlKey) {
            event.preventDefault(); 
        }
    }, { passive: false });
</script>

