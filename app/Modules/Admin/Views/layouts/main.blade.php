<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">

    <title>{{ $title or 'Административная панель' }}</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/morris/morris.css') }}">

    @stack('styles')

    <!-- App css -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{ asset('backend/js/modernizr.min.js') }}"></script>

</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left hidden-xs">
            <a href="{{ route('admin.index') }}" class="logo">
                <span>Admin<span>to</span></span>
                <i class="zmdi zmdi-layers"></i>
            </a>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">

                <!-- Page title -->
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <button class="button-menu-mobile open-left">
                            <i class="zmdi zmdi-menu"></i>
                        </button>
                    </li>
                    <li class="hidden-xs">
                        <h4 class="page-title">{{ $title or 'Административная панель' }}</h4>
                    </li>
                </ul>

                <!-- Right(Notification and Searchbox -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <!-- Notification -->
                        <div class="notification-box">
                            <ul class="list-inline m-b-0">
                                <li>
                                    <a href="javascript:void(0);" class="right-bar-toggle">
                                        <i class="zmdi zmdi-notifications-none"></i>
                                    </a>
                                    <div class="noti-dot">
                                        <span class="dot"></span>
                                        <span class="pulse"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- End Notification bar -->
                    </li>
                    <li class="hidden-xs">
                        <form role="search" class="app-search">
                            <input type="text" placeholder="Поиск..."
                                   class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>

            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">

            <!-- User -->
            <div class="user-box">
                <div class="user-img">
                    <img src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ Auth::user()->login }}" title="{{ Auth::user()->login }}" class="img-circle img-thumbnail img-responsive">
                    <div class="user-status online"><i class="fa fa-circle"></i></div>
                </div>
                <h5>{{ Auth::user()->login }}</h5>
                <ul class="list-inline">
                    <li>
                        <a href="#" >
                            <i class="fa fa-cog"></i>
                        </a>
                    </li>

                    <li>
                        <a href="{{ URL::to('logout') }}" class="text-custom">
                            <i class="fa fa-power-off"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End User -->

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ route('admin.index') }}" class="waves-effect active">
                            <i class="zmdi zmdi-view-dashboard"></i>
                            <span>Главная</span>
                        </a>
                    </li>
                    <li>
                        <a href="orders.html" class="waves-effect">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Заказы</span>
                            <span class="label label-success pull-right">7</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="fa fa-phone"></i>
                            <span>Звонки</span>
                            <span class="label label-info pull-right">7</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="fa fa-envelope"></i>
                            <span>Письма</span>
                            <span class="label label-warning pull-right">7</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="fa fa-comment"></i>
                            <span>Отзывы</span>
                            <span class="label label-danger pull-right">7</span>
                        </a>
                    </li>

                    <hr>

                    <li>
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Товары</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pages.index') }}" class="waves-effect">
                            <i class="fa fa-file"></i>
                            <span>Страницы</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="fa fa-users"></i>
                            <span>Пользователи</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.index') }}" class="waves-effect">
                            <i class="fa fa-cogs"></i>
                            <span>Настройки</span>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>

    </div>
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <div class="row visible-xs">
                    <div class="col-md-12">
                        <h4 class="page-title m-b-15">{{ $title or 'Административная панель' }}</h4>
                    </div>
                </div>

                @yield('content')

            </div> <!-- container -->
        </div> <!-- content -->

        <footer class="footer text-right">
            2016 © Разработано студией IT Hill.
        </footer>

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


    <!-- Right Sidebar -->
    <div class="side-bar right-bar">
        <a href="javascript:void(0);" class="right-bar-toggle">
            <i class="zmdi zmdi-close-circle-o"></i>
        </a>
        <h4 class="">Notifications</h4>
        <div class="notification-list nicescroll">
            <ul class="list-group list-no-border user-list">
                <li class="list-group-item">
                    <a href="#" class="user-list-item">
                        <div class="avatar">
                            <img src="{{ asset('backend/images/users/avatar-2.jpg') }}" alt="">
                        </div>
                        <div class="user-desc">
                            <span class="name">Michael Zenaty</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">2 hours ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="user-list-item">
                        <div class="icon bg-info">
                            <i class="zmdi zmdi-account"></i>
                        </div>
                        <div class="user-desc">
                            <span class="name">New Signup</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">5 hours ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="user-list-item">
                        <div class="icon bg-pink">
                            <i class="zmdi zmdi-comment"></i>
                        </div>
                        <div class="user-desc">
                            <span class="name">New Message received</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">1 day ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item active">
                    <a href="#" class="user-list-item">
                        <div class="avatar">
                            <img src="{{ asset('backend/images/users/avatar-3.jpg') }}" alt="">
                        </div>
                        <div class="user-desc">
                            <span class="name">James Anderson</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">2 days ago</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item active">
                    <a href="#" class="user-list-item">
                        <div class="icon bg-warning">
                            <i class="zmdi zmdi-settings"></i>
                        </div>
                        <div class="user-desc">
                            <span class="name">Settings</span>
                            <span class="desc">There are new settings available</span>
                            <span class="time">1 day ago</span>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <!-- /Right-bar -->

</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/detect.js') }}"></script>
<script src="{{ asset('backend/js/fastclick.js') }}"></script>
<script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('backend/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('backend/js/waves.js') }}"></script>
<script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('backend/js/jquery.scrollTo.min.js') }}"></script>

<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="{{ asset('backend/plugins/jquery-knob/excanvas.js') }}"></script>
<![endif]-->
<script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.js') }}"></script>

<!--Morris Chart-->
<script src="{{ asset('backend/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('backend/plugins/raphael/raphael-min.js') }}"></script>

<!-- Dashboard init -->
<script src="{{ asset('backend/pages/jquery.dashboard.js') }}"></script>

@stack('scripts')

<!-- App js -->
<script src="{{ asset('backend/js/jquery.core.js') }}"></script>
<script src="{{ asset('backend/js/jquery.app.js') }}"></script>

</body>
</html>