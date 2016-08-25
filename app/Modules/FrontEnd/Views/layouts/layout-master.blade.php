<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Billing System | </title>

    <!-- Bootstrap -->
    <link href="{{URL::asset('gentelella_template/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::asset('gentelella_template/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{URL::asset('gentelella_template/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
{{--    <link href="{{URL::asset('gentelella_template/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">--}}
    <!-- bootstrap-progressbar -->
    <link href="{{URL::asset('gentelella_template/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
{{--    <link href="{{URL::asset('gentelella_template/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>--}}

    <!-- iCheck -->
    <link href="{{URL::asset('gentelella_template/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{URL::asset('gentelella_template/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('gentelella_template/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('gentelella_template/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('gentelella_template/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('gentelella_template/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    
    <!-- Tag Input -->
    <link href="{{URL::asset('css/bootstrap-tagsinput.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{URL::asset('gentelella_template/build/css/custom.min.css')}}" rel="stylesheet">
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
                        <span>Billing System</span>
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
                        @if(Session::get('guard') == 'sysusers')
                            <li><a><i class="fa fa-home"></i> Dashboard <span class="fa"></span></a></li>
                            <li><a><i class="fa fa-edit"></i> Account <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="#">Agent Accounts</a></li>
                                    <li><a href="{{URL::route('BillingSystemAccount.index')}}">Accounts</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-credit-card"></i> Charge Management<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{URL::route('BillingSystemCharge.create')}}">Charge</a></li>
                                    <li><a href="{{URL::route('BillingSystemCharge.index')}}">Charge Log</a></li>
                                </ul>
                            </li>
                            <li><a href="{{URL::route('BillingSystemRate.index')}}"><i class="fa fa-home"></i> Rate <span class="fa"></span></a></li>
                            <li><a href="{{URL::route('BillingSystemPrefix.index')}}"><i class="fa fa-home"></i> Prefix <span class="fa"></span></a></li>
                            <li><a href="{{URL::route('BillingSystemCalllog.index')}}"><i class="fa fa-phone"></i> CallLog <span class="fa"></span></a></li>
                            <li><a href="{{URL::route('BillingSystemSystem.index')}}"><i class="fa fa-server"></i> System <span class="fa"></span></a></li>
                            <li><a href="{{URL::route('BillingSystemSysuser.index')}}"><i class="fa fa-group"></i> System User <span class="fa"></span></a></li>
                        @elseif(Session::get('guard') == 'accounts')
                            <li><a><i class="fa fa-home"></i> Dashboard <span class="fa"></span></a></li>
                            <li><a><i class="fa fa-credit-card"></i> Charge Management<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                @if(Auth::guard(Session::get('guard'))->user()->AccountType == 1)
                                    <li><a href="{{URL::route('BillingSystemCharge.create')}}">Charge</a></li>
                                @endif
                                    <li><a href="{{URL::route('BillingSystemCharge.index')}}">Charge Log</a></li>
                                </ul>
                            </li>
                        @endif
                            {{--<li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                    {{--<li><a href="form.html">General Form</a></li>--}}
                                    {{--<li><a href="form_advanced.html">Advanced Components</a></li>--}}
                                    {{--<li><a href="form_validation.html">Form Validation</a></li>--}}
                                    {{--<li><a href="form_wizards.html">Form Wizard</a></li>--}}
                                    {{--<li><a href="form_upload.html">Form Upload</a></li>--}}
                                    {{--<li><a href="form_buttons.html">Form Buttons</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                    {{--<li><a href="general_elements.html">General Elements</a></li>--}}
                                    {{--<li><a href="media_gallery.html">Media Gallery</a></li>--}}
                                    {{--<li><a href="typography.html">Typography</a></li>--}}
                                    {{--<li><a href="icons.html">Icons</a></li>--}}
                                    {{--<li><a href="glyphicons.html">Glyphicons</a></li>--}}
                                    {{--<li><a href="widgets.html">Widgets</a></li>--}}
                                    {{--<li><a href="invoice.html">Invoice</a></li>--}}
                                    {{--<li><a href="inbox.html">Inbox</a></li>--}}
                                    {{--<li><a href="calendar.html">Calendar</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                    {{--<li><a href="tables.html">Tables</a></li>--}}
                                    {{--<li><a href="tables_dynamic.html">Table Dynamic</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                    {{--<li><a href="chartjs.html">Chart JS</a></li>--}}
                                    {{--<li><a href="chartjs2.html">Chart JS2</a></li>--}}
                                    {{--<li><a href="morisjs.html">Moris JS</a></li>--}}
                                    {{--<li><a href="echarts.html">ECharts</a></li>--}}
                                    {{--<li><a href="other_charts.html">Other Charts</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                    {{--<li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>--}}
                                    {{--<li><a href="fixed_footer.html">Fixed Footer</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                    {{--<div class="menu_section">--}}
                        {{--<h3>Live On</h3>--}}
                        {{--<ul class="nav side-menu">--}}
                            {{--<li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                    {{--<li><a href="e_commerce.html">E-commerce</a></li>--}}
                                    {{--<li><a href="projects.html">Projects</a></li>--}}
                                    {{--<li><a href="project_detail.html">Project Detail</a></li>--}}
                                    {{--<li><a href="contacts.html">Contacts</a></li>--}}
                                    {{--<li><a href="profile.html">Profile</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                    {{--<li><a href="page_403.html">403 Error</a></li>--}}
                                    {{--<li><a href="page_404.html">404 Error</a></li>--}}
                                    {{--<li><a href="page_500.html">500 Error</a></li>--}}
                                    {{--<li><a href="plain_page.html">Plain Page</a></li>--}}
                                    {{--<li><a href="login.html">Login Page</a></li>--}}
                                    {{--<li><a href="pricing_tables.html">Pricing Tables</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>--}}
                                {{--<ul class="nav child_menu">--}}
                                    {{--<li><a href="#level1_1">Level One</a>--}}
                                    {{--<li><a>Level One<span class="fa fa-chevron-down"></span></a>--}}
                                        {{--<ul class="nav child_menu">--}}
                                            {{--<li class="sub_menu"><a href="level2.html">Level Two</a>--}}
                                            {{--</li>--}}
                                            {{--<li><a href="#level2_1">Level Two</a>--}}
                                            {{--</li>--}}
                                            {{--<li><a href="#level2_2">Level Two</a>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                    {{--<li><a href="#level1_2">Level One</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}

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
                                <li><a href="{{URL::route('BillingSystemAuth.logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
                                    <li><a href="#" data-href="{{URL::route('BillingSystemAjax.applyHTBSChange',['needUpdate' => 'all'])}}">Reload All</a></li>
                                    <li><a href="#" data-href="{{URL::route('BillingSystemAjax.applyHTBSChange',['needUpdate' => 'account'])}}">Reload Account</a></li>
                                    <li><a href="#" data-href="{{URL::route('BillingSystemAjax.applyHTBSChange',['needUpdate' => 'rate'])}}">Reload Rate</a></li>
                                    <li><a href="#" data-href="{{URL::route('BillingSystemAjax.applyHTBSChange',['needUpdate' => 'rateitem'])}}">Reload RateItem</a></li>
                                    <li><a href="#" data-href="{{URL::route('BillingSystemAjax.applyHTBSChange',['needUpdate' => 'prefix'])}}">Reload Prefix</a></li>
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
<script src="{{URL::asset('gentelella_template/vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{URL::asset('gentelella_template/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{URL::asset('gentelella_template/vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{URL::asset('gentelella_template/vendors/nprogress/nprogress.js')}}"></script>
<!-- iCheck -->
<script src="{{URL::asset('gentelella_template/vendors/iCheck/icheck.js')}}"></script>

<!-- Chart.js -->
{{--<script src="{{URL::asset('gentelella_template/vendors/Chart.js/dist/Chart.min.js')}}"></script>--}}
<!-- gauge.js -->
{{--<script src="{{URL::asset('gentelella_template/vendors/gauge.js/dist/gauge.min.js')}}"></script>--}}
<!-- bootstrap-progressbar -->
<script src="{{URL::asset('gentelella_template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>

<!-- Skycons -->
{{--<script src="{{URL::asset('gentelella_template/vendors/skycons/skycons.js')}}"></script>--}}

<!-- Flot -->
{{--<script src="{{URL::asset('gentelella_template/vendors/Flot/jquery.flot.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/Flot/jquery.flot.pie.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/Flot/jquery.flot.time.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/Flot/jquery.flot.stack.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/Flot/jquery.flot.resize.js')}}"></script>--}}
<!-- Flot plugins -->
{{--<script src="{{URL::asset('gentelella_template/production/js/flot/jquery.flot.orderBars.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/production/js/flot/date.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/production/js/flot/jquery.flot.spline.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/production/js/flot/curvedLines.js')}}"></script>--}}
<!-- JQVMap -->
{{--<script src="{{URL::asset('gentelella_template/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>--}}
<!-- bootstrap-daterangepicker -->
{{--<script src="{{URL::asset('gentelella_template/production/js/moment/moment.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/production/js/datepicker/daterangepicker.js')}}"></script>--}}


<!-- Datatables -->
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/datatables.net-scroller/js/datatables.scroller.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/jszip/dist/jszip.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/pdfmake/build/pdfmake.min.js')}}"></script>--}}
{{--<script src="{{URL::asset('gentelella_template/vendors/pdfmake/build/vfs_fonts.js')}}"></script>--}}

<!-- Custom Theme Scripts -->
{{--<script src="{{URL::asset('gentelella_template/build/js/custom.js')}}"></script>--}}

<!-- Flot -->
{{--<script>--}}
    {{--$(document).ready(function() {--}}
        {{--var data1 = [--}}
            {{--[gd(2012, 1, 1), 17],--}}
            {{--[gd(2012, 1, 2), 74],--}}
            {{--[gd(2012, 1, 3), 6],--}}
            {{--[gd(2012, 1, 4), 39],--}}
            {{--[gd(2012, 1, 5), 20],--}}
            {{--[gd(2012, 1, 6), 85],--}}
            {{--[gd(2012, 1, 7), 7]--}}
        {{--];--}}

        {{--var data2 = [--}}
            {{--[gd(2012, 1, 1), 82],--}}
            {{--[gd(2012, 1, 2), 23],--}}
            {{--[gd(2012, 1, 3), 66],--}}
            {{--[gd(2012, 1, 4), 9],--}}
            {{--[gd(2012, 1, 5), 119],--}}
            {{--[gd(2012, 1, 6), 6],--}}
            {{--[gd(2012, 1, 7), 9]--}}
        {{--];--}}
        {{--$("#canvas_dahs").length && $.plot($("#canvas_dahs"), [--}}
            {{--data1, data2--}}
        {{--], {--}}
            {{--series: {--}}
                {{--lines: {--}}
                    {{--show: false,--}}
                    {{--fill: true--}}
                {{--},--}}
                {{--splines: {--}}
                    {{--show: true,--}}
                    {{--tension: 0.4,--}}
                    {{--lineWidth: 1,--}}
                    {{--fill: 0.4--}}
                {{--},--}}
                {{--points: {--}}
                    {{--radius: 0,--}}
                    {{--show: true--}}
                {{--},--}}
                {{--shadowSize: 2--}}
            {{--},--}}
            {{--grid: {--}}
                {{--verticalLines: true,--}}
                {{--hoverable: true,--}}
                {{--clickable: true,--}}
                {{--tickColor: "#d5d5d5",--}}
                {{--borderWidth: 1,--}}
                {{--color: '#fff'--}}
            {{--},--}}
            {{--colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],--}}
            {{--xaxis: {--}}
                {{--tickColor: "rgba(51, 51, 51, 0.06)",--}}
                {{--mode: "time",--}}
                {{--tickSize: [1, "day"],--}}
                {{--//tickLength: 10,--}}
                {{--axisLabel: "Date",--}}
                {{--axisLabelUseCanvas: true,--}}
                {{--axisLabelFontSizePixels: 12,--}}
                {{--axisLabelFontFamily: 'Verdana, Arial',--}}
                {{--axisLabelPadding: 10--}}
            {{--},--}}
            {{--yaxis: {--}}
                {{--ticks: 8,--}}
                {{--tickColor: "rgba(51, 51, 51, 0.06)",--}}
            {{--},--}}
            {{--tooltip: false--}}
        {{--});--}}

        {{--function gd(year, month, day) {--}}
            {{--return new Date(year, month - 1, day).getTime();--}}
        {{--}--}}
    {{--});--}}
{{--</script>--}}
<!-- /Flot -->

<!-- JQVMap -->
{{--<script>--}}
    {{--$(document).ready(function(){--}}
        {{--$('#world-map-gdp').vectorMap({--}}
            {{--map: 'world_en',--}}
            {{--backgroundColor: null,--}}
            {{--color: '#ffffff',--}}
            {{--hoverOpacity: 0.7,--}}
            {{--selectedColor: '#666666',--}}
            {{--enableZoom: true,--}}
            {{--showTooltip: true,--}}
            {{--values: sample_data,--}}
            {{--scaleColors: ['#E6F2F0', '#149B7E'],--}}
            {{--normalizeFunction: 'polynomial'--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}
<!-- /JQVMap -->

<!-- Skycons -->
{{--<script>--}}
    {{--$(document).ready(function() {--}}
        {{--var icons = new Skycons({--}}
                    {{--"color": "#73879C"--}}
                {{--}),--}}
                {{--list = [--}}
                    {{--"clear-day", "clear-night", "partly-cloudy-day",--}}
                    {{--"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",--}}
                    {{--"fog"--}}
                {{--],--}}
                {{--i;--}}

        {{--for (i = list.length; i--;)--}}
            {{--icons.set(list[i], list[i]);--}}

        {{--icons.play();--}}
    {{--});--}}
{{--</script>--}}
<!-- /Skycons -->

<!-- Doughnut Chart -->
{{--<script>--}}
    {{--$(document).ready(function(){--}}
        {{--var options = {--}}
            {{--legend: false,--}}
            {{--responsive: false--}}
        {{--};--}}

        {{--new Chart(document.getElementById("canvas1"), {--}}
            {{--type: 'doughnut',--}}
            {{--tooltipFillColor: "rgba(51, 51, 51, 0.55)",--}}
            {{--data: {--}}
                {{--labels: [--}}
                    {{--"Symbian",--}}
                    {{--"Blackberry",--}}
                    {{--"Other",--}}
                    {{--"Android",--}}
                    {{--"IOS"--}}
                {{--],--}}
                {{--datasets: [{--}}
                    {{--data: [15, 20, 30, 10, 30],--}}
                    {{--backgroundColor: [--}}
                        {{--"#BDC3C7",--}}
                        {{--"#9B59B6",--}}
                        {{--"#E74C3C",--}}
                        {{--"#26B99A",--}}
                        {{--"#3498DB"--}}
                    {{--],--}}
                    {{--hoverBackgroundColor: [--}}
                        {{--"#CFD4D8",--}}
                        {{--"#B370CF",--}}
                        {{--"#E95E4F",--}}
                        {{--"#36CAAB",--}}
                        {{--"#49A9EA"--}}
                    {{--]--}}
                {{--}]--}}
            {{--},--}}
            {{--options: options--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}
<!-- /Doughnut Chart -->

<!-- bootstrap-daterangepicker -->
{{--<script>--}}
    {{--$(document).ready(function() {--}}

        {{--var cb = function(start, end, label) {--}}
            {{--console.log(start.toISOString(), end.toISOString(), label);--}}
            {{--$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));--}}
        {{--};--}}

        {{--var optionSet1 = {--}}
            {{--startDate: moment().subtract(29, 'days'),--}}
            {{--endDate: moment(),--}}
            {{--minDate: '01/01/2012',--}}
            {{--maxDate: '12/31/2015',--}}
            {{--dateLimit: {--}}
                {{--days: 60--}}
            {{--},--}}
            {{--showDropdowns: true,--}}
            {{--showWeekNumbers: true,--}}
            {{--timePicker: false,--}}
            {{--timePickerIncrement: 1,--}}
            {{--timePicker12Hour: true,--}}
            {{--ranges: {--}}
                {{--'Today': [moment(), moment()],--}}
                {{--'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],--}}
                {{--'Last 7 Days': [moment().subtract(6, 'days'), moment()],--}}
                {{--'Last 30 Days': [moment().subtract(29, 'days'), moment()],--}}
                {{--'This Month': [moment().startOf('month'), moment().endOf('month')],--}}
                {{--'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]--}}
            {{--},--}}
            {{--opens: 'left',--}}
            {{--buttonClasses: ['btn btn-default'],--}}
            {{--applyClass: 'btn-small btn-primary',--}}
            {{--cancelClass: 'btn-small',--}}
            {{--format: 'MM/DD/YYYY',--}}
            {{--separator: ' to ',--}}
            {{--locale: {--}}
                {{--applyLabel: 'Submit',--}}
                {{--cancelLabel: 'Clear',--}}
                {{--fromLabel: 'From',--}}
                {{--toLabel: 'To',--}}
                {{--customRangeLabel: 'Custom',--}}
                {{--daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],--}}
                {{--monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],--}}
                {{--firstDay: 1--}}
            {{--}--}}
        {{--};--}}
        {{--$('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));--}}
        {{--$('#reportrange').daterangepicker(optionSet1, cb);--}}
        {{--$('#reportrange').on('show.daterangepicker', function() {--}}
            {{--console.log("show event fired");--}}
        {{--});--}}
        {{--$('#reportrange').on('hide.daterangepicker', function() {--}}
            {{--console.log("hide event fired");--}}
        {{--});--}}
        {{--$('#reportrange').on('apply.daterangepicker', function(ev, picker) {--}}
            {{--console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));--}}
        {{--});--}}
        {{--$('#reportrange').on('cancel.daterangepicker', function(ev, picker) {--}}
            {{--console.log("cancel event fired");--}}
        {{--});--}}
        {{--$('#options1').click(function() {--}}
            {{--$('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);--}}
        {{--});--}}
        {{--$('#options2').click(function() {--}}
            {{--$('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);--}}
        {{--});--}}
        {{--$('#destroy').click(function() {--}}
            {{--$('#reportrange').data('daterangepicker').remove();--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}
<!-- /bootstrap-daterangepicker -->

<!-- gauge.js -->
{{--<script>--}}
    {{--var opts = {--}}
        {{--lines: 12,--}}
        {{--angle: 0,--}}
        {{--lineWidth: 0.4,--}}
        {{--pointer: {--}}
            {{--length: 0.75,--}}
            {{--strokeWidth: 0.042,--}}
            {{--color: '#1D212A'--}}
        {{--},--}}
        {{--limitMax: 'false',--}}
        {{--colorStart: '#1ABC9C',--}}
        {{--colorStop: '#1ABC9C',--}}
        {{--strokeColor: '#F0F3F3',--}}
        {{--generateGradient: true--}}
    {{--};--}}
    {{--var target = document.getElementById('foo'),--}}
            {{--gauge = new Gauge(target).setOptions(opts);--}}

    {{--gauge.maxValue = 6000;--}}
    {{--gauge.animationSpeed = 32;--}}
    {{--gauge.set(3200);--}}
    {{--gauge.setTextField(document.getElementById("gauge-text"));--}}
{{--</script>--}}
<script type="text/javascript">
    var config = {
        AJAX_LOAD_ACCOUNT_PER_PAGE_URL: {
            "url":"{{route('BillingSystemAjax.loadAccountTableByPerpage')}}",
            "params":{}
        },
        AJAX_LOAD_CHILDACCOUNT_PER_PAGE_URL: {
            "url":"{{route('BillingSystemAjax.loadChildAccountTableByPerpage')}}",
            "params":{}
        },
        AJAX_LOAD_CALL_LOG_PER_PAGE_URL: {
            "tableName":"callLog",
            "url":"{{route('BillingSystemAjax.loadCalllogTableByPerpage')}}",
            "params":{}
        },
        AJAX_LOAD_LOGGEDLOG_PER_PAGE_URL: {
            "tableName":"loggedLog",
            "url":"{{route('BillingSystemAjax.loadLoggedlogTableByPerpage')}}",
            "params":{}
        },
        AJAX_LOAD_RATE_PER_PAGE_URL:  {
            "url":"{{route('BillingSystemAjax.loadRateTableByPerpage')}}",
            "params":{}
        },
        AJAX_LOAD_RATE_ITEM_PER_PAGE_URL:  {
            "url":"{{route('BillingSystemAjax.loadRateitemTableByPerpage')}}",
            "params":{}
        },
        AJAX_LOAD_PREFIX_PER_PAGE_URL:  {
            "url":"{{route('BillingSystemAjax.loadPrefixTableByPerpage')}}",
            "params":{}
        },
        AJAX_LOAD_SYSUSER_PER_PAGE_URL:  {
            "url":"{{route('BillingSystemAjax.loadSysuserTableByPerpage')}}",
            "params":{}
        },
        AJAX_LOAD_SYSTEM_PER_PAGE_URL:  {
            "url":"{{route('BillingSystemAjax.loadSystemTableByPerpage')}}",
            "params":{}
        },
        AJAX_LOAD_CHARGELOG_PER_PAGE_URL:  {
            "url":"{{route('BillingSystemAjax.loadChargelogTableByPerpage')}}",
            "params":{}
        },
        AJAX_EXPORT_CALLLOG_URL:  {
            "tableName":"callLog",
            "url":"{{route('BillingSystemAjax.exportCallLog')}}",
            "params":{}
        },
        AJAX_LOAD_RATE_SELECT_URL: "{{route('BSapi.getRatesByAgent')}}",
    }
</script>

<script src="{{URL::asset('js/bootstrap-tagsinput.js')}}"></script>
<script src="{{URL::asset('js/typeahead.js')}}"></script>
<script src="{{URL::asset('js/bs-app.js')}}"></script>
@yield('js-section')
<!-- /gauge.js -->
</body>
</html>