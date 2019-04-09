<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Tell the browser to be responsive to screen width -->

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">

        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Favicon icon -->

        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/images/favicon.png') }}">

        <title>Auto marketing</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('public/css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{ asset('public/css/lib/calendar2/semantic.ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/lib/calendar2/pignose.calendar.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/lib/owl.carousel.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/css/lib/owl.theme.default.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/css/helper.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/custom.css?v=0.2.7') }}" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
        <!--[if lt IE 9]>
        <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    	
        @yield('other_styles')

    </head>

    <body class="fix-header fix-sidebar">

    <!-- Preloader - style you can find in spinners.css -->

    <div class="preloader">

        <svg class="circular" viewBox="25 25 50 50">

            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>

    </div>

    <!-- Main wrapper  -->

    <div id="main-wrapper">

        <!-- header header  -->

        <div class="header">
            @include('navbar');
        </div>

        <!-- End header header -->

        <!-- Left Sidebar  -->

        <div class="left-sidebar">

            <!-- Sidebar scroll-->
           @include('left-sidebar');
            <!-- End Sidebar scroll-->

        </div>

        <!-- End Left Sidebar  -->

        <!-- Page wrapper  -->

        <div class="page-wrapper">

            <!-- Bread crumb -->

            <div class="row page-titles">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-primary">Dashboard</h3> </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ url('/svcustomer') }}">Home</a></li>

                        <li class="breadcrumb-item active">Dashboard</li>

                    </ol>

                </div>

            </div>

            <!-- End Bread crumb -->

            <!-- Container fluid  -->

            <div class="container-fluid">

                <!-- Start Page Content -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
               @yield('content')

                <!-- End PAge Content -->

            </div>

            <!-- End Container fluid  -->

            <!-- footer -->

            <footer class="footer"> © 2018 All rights reserved. Develope by <a href="http://zutheme.com">hatazu</a></footer>

            <!-- End footer -->

        </div>

        <!-- End Page wrapper  -->

    </div>

    <!-- End Wrapper -->

       <!-- All Jquery -->

    <script src="{{ asset('public/js/lib/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap tether Core JavaScript -->

    <script src="{{ asset('public/js/lib/bootstrap/js/popper.min.js') }}"></script>

    <script src="{{ asset('public/js/lib/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- slimscrollbar scrollbar JavaScript -->

    <script src="{{ asset('public/js/jquery.slimscroll.js') }}"></script>

    <!--Menu sidebar -->

    <script src="{{ asset('public/js/sidebarmenu.js') }}"></script>

    <!--stickey kit -->

    <script src="{{ asset('public/js/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

    <!--Custom JavaScript -->

    <script src="{{ asset('public/js/custom.min.js') }}"></script>
    <script src="{{ asset('public/js/custom.js?v=0.9.2') }}"></script>
    <script src="{{ asset('public/js/lib/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('public/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('public/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/js/lib/datatables/datatables-init.js') }}"></script>

        @yield('other_scripts')

    </body>

</html>