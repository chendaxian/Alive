<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{URL::asset('img/logo.jpg')}}">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">

    <title>悦享小程序工作后台</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-confirm.min.css') }}" rel="stylesheet">


    <!--Animation css-->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <!--Icon-fonts css-->
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/ionicon/css/ionicons.min.css') }}" rel="stylesheet"/>
 

    <!-- sweet alerts -->
    <link href="{{ asset('assets/sweet-alert/sweet-alert.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{  asset('assets/modal-effect/css/component.css') }}" rel="stylesheet">
    <link href="{{  asset('css/select2.min.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <![endif]-->
    @yield('top_style')
    <link href="{{ asset('css/bootstrap-timepicker.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/overhidden.css') }}" rel="stylesheet"/>
</head>
<body>
@include('layouts.admin.left_side')
<section class="content">
    <!-- Header -->
    <header class="top-head container-fluid">
        <button type="button" class="navbar-toggle pull-left">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- Right navbar -->

        <ul class="list-inline navbar-right top-menu top-right-menu">
            <!-- user login dropdown start-->
            <li class="dropdown text-center">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="username">{{ Auth::user()->name }}</span> <span class="caret"></span>
                </a>
                <ul style="z-index: 10000" class="dropdown-menu extended pro-menu fadeInUp animated" tabindex="5003"
                    style="overflow: hidden; outline: none;">
                    

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> 退出
                    </a>
                    </li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!-- End right navbar -->
    </header>
    <!-- Header Ends -->
    <!-- Page Content Start -->
    <!-- ================== -->
    <div class="wraper container-fluid">
        @yield('content')
    </div>
    <!-- Page Content Ends -->
    <!-- ================== -->
    <!-- Footer Start -->
    <footer class="footer">
    </footer>
    <!-- Footer Ends -->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/modernizr.min.js') }}"></script>
<script src="{{ asset('js/pace.min.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/chat/moment-2.2.1.js') }}"></script>

<!-- Counter-up -->
<script src="{{ asset('js/waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}" type="text/javascript"></script>

<!-- EASY PIE CHART JS -->
<script src="{{ asset('assets/easypie-chart/easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/easypie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/easypie-chart/example.js') }}"></script>


<!--C3 Chart-->
<script src="{{ asset('assets/c3-chart/d3.v3.min.js') }}"></script>
<script src="{{ asset('assets/c3-chart/c3.js') }}"></script>

<!--Morris Chart-->
<script src="{{ asset('assets/morris/morris.min.js') }}"></script>  
<script src="{{ asset('assets/morris/raphael.min.js') }}"></script>

<!-- sparkline -->
<script src="{{ asset('assets/sparkline-chart/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/sparkline-chart/chart-sparkline.js') }}" type="text/javascript"></script>

<!-- sweet alerts -->
<script src="{{ asset('assets/sweet-alert/sweet-alert.min.js') }}"></script>
<script src="{{ asset('assets/sweet-alert/sweet-alert.init.js') }}"></script>

<script src="{{ asset('js/jquery.app.js') }}"></script>
<!-- Chat -->
<script src="{{ asset('js/jquery.chat.js') }}"></script>
<!-- Dashboard -->
<script src="{{ asset('js/jquery.dashboard.js') }}"></script>

<!-- Todo -->
<script src="{{ asset('js/jquery.todo.js') }}"></script>

<script src="{{ asset('assets/modal-effect/js/classie.js') }}"></script>
<script src="{{ asset('assets/modal-effect/js/modalEffects.js') }}"></script>
<script src="{{ asset('js/wangEditor.min.js') }}"></script>
<script type="text/javascript">
    /* ==============================================
     Counter Up
     =============================================== */
    jQuery(document).ready(function ($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
    });
</script>
@yield('bottom_script')
</body>
</html>
