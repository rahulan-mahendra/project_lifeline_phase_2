<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LIFELINE HEALTHCARE GROUP</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <!-- Fevicon -->
    <link rel="shortcut icon" href="{{asset('admin/assets/images/color_logo_no_background.svg')}}">
    <!-- Start css -->
    <!-- Switchery css -->
    <link href="{{asset('admin/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    <!-- Apex css -->
    <link href="{{asset('admin/assets/plugins/apexcharts/apexcharts.css')}}" rel="stylesheet">
    <!-- Slick css -->
    <link href="{{asset('admin/assets/plugins/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/slick/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/flag-icon.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet" type="text/css">

    @stack('css')
    <!-- End css -->
</head>
<body class="vertical-layout">
    <!-- Start Infobar Setting Sidebar -->
    @include('includes.info')
    <!-- End Infobar Setting Sidebar -->

        <!-- Start Containerbar -->
        <div id="containerbar">
            <!-- Start Leftbar -->
            <div class="leftbar">
                <!-- Start Sidebar -->
                <div class="sidebar">
                    <!-- Start Logobar -->
                    <div class="logobar">
                        <a href="{{route('dashboard')}}" class="logo logo-large">
                            <img src="{{asset('admin/assets/images/lifeline_logo_remove_bg.png')}}" class="img-fluid" alt="logo">
                            {{-- <h5 class="text-white">LIFELINE</h5> --}}
                        </a>
                        <a href="{{route('dashboard')}}" class="logo logo-small">
                            <img src="{{asset('admin/assets/images/lifeline_logo_remove_bg.png')}}" class="img-fluid" alt="logo">
                            {{-- <h5 class="text-white">LIFELINE</h5> --}}
                        </a>
                    </div>
                    <!-- End Logobar -->
                    <!-- Start Navigationbar -->
                    @include('includes.nav')
                    <!-- End Navigationbar -->
                </div>
                <!-- End Sidebar -->
            </div>
            <!-- End Leftbar -->
            <!-- Start Rightbar -->
            <div class="rightbar">
                <!-- Start Topbar Mobile -->
                @include('includes.topbar-mobile')
                <!-- End Topbar Mobile -->
                <!-- Start Topbar -->
                @include('includes.topbar')
                <!-- End Topbar -->

                @yield('content')

                <!-- Start Footerbar -->
                @include('includes.footer')
                <!-- End Footerbar -->
            </div>
            <!-- End Rightbar -->
        </div>
        <!-- End Containerbar -->

        <!-- Start Modals -->

         <!-- Logout Modal -->
        @include('includes.logout-modal')



        <!-- End Modals -->
    <!-- Start js -->
    <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('admin/assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/detect.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('admin/assets/js/vertical-menu.js')}}"></script>

    <!-- Switchery js -->
    <script src="{{asset('admin/assets/plugins/switchery/switchery.min.js')}}"></script>



    @stack('script')
    <!-- Core js -->
    <script src="{{asset('admin/assets/js/core.js')}}"></script>
    <!-- End js -->

    <script>
        function onLogout(){
            $('#logout-form').submit();
        }
    </script>
</body>
</html>
