<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel CMS | </title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{URL::asset('css/nprogress.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{URL::asset('css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">

    <!-- iCheck -->
    <link href="{{URL::asset('css/green.css')}}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{URL::asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{URL::asset('css/custom.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/bs-app.css')}}" rel="stylesheet">
    @yield('css-section')
</head>

<body class="nav-md" id="@yield('page-name-section')">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title">
                        {{--<i class="fa fa-paw"></i> --}}
                        <span>Laravel CMS</span>
                    </a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="images/user.png" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>
                            @if(Session::get('guard') == 'sysusers')
                                {{Auth::guard('sysusers')->user()->UserName}}
                            @elseif(Session::get('guard') == 'accounts')
                                {{Auth::guard('accounts')->user()->Name}}
                            @endif
                        </h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        {{--<h3>Billing System</h3>--}}
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Dashboard <span class="fa"></span></a></li>
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="images/user.png" alt="">
                                @if(Session::get('guard') == 'sysusers')
                                    {{Auth::guard('sysusers')->user()->UserName}}
                                @elseif(Session::get('guard') == 'accounts')
                                    {{Auth::guard('accounts')->user()->Name}}
                                @endif
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;"> Profile</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li><a href="javascript:;">Help</a></li>
                                <li><a href="{{URL::route('BackEndAuth.logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="images/user.png" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/user.png" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/user.png" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/user.png" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="@yield('role-section')">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="page-content">
                    <div class="x_title">
                        <h2> @yield('title-page-section')</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu" id="applyHTBSChange">
                                    <li><a href="#" data-href="">Reload All</a></li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="pull-right inline-breadcrumb">
                            @yield('breadcrumb-section')
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    @yield('content-section')
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<input type="hidden" name="env_debug" id="env_debug" value="{{env('APP_DEBUG')}}">
<!-- jQuery -->
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{URL::asset('js/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{URL::asset('js/nprogress.js')}}"></script>
<!-- iCheck -->
<script src="{{URL::asset('js/icheck.js')}}"></script>

<!-- bootstrap-progressbar -->
<script src="{{URL::asset('js/bootstrap-progressbar.min.js')}}"></script>
<script src="{{URL::asset('js/bs-app.js')}}"></script>
@yield('js-section')
<!-- /gauge.js -->
</body>
</html>