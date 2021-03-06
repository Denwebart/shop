<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="Административная панель интернет-магазина.">
    <meta name="author" content="Coderthemes">
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">

    <title>{{ $title or 'Административная панель' }}</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/morris/morris.css') }}">

    <!-- Notification css (Toastr) -->
    <link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

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
            <a href="{{ url('/') }}" class="back-to-site pull-left" target="_blank" title="Перейти на сайт" data-toggle="tooltip" data-placement="right">
                <i class="fa fa-arrow-left"></i>
            </a>
            <a href="{{ route('admin.index') }}" class="logo">
                <span>Admin<span> panel</span></span>
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
                                    <div class="noti-dot @if(!count(Auth::user()->notifications)) hidden @endif">
                                        <span class="dot"></span>
                                        <span class="pulse"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- End Notification bar -->
                    </li>
                    <li class="hidden-xs">
                        @include('admin::layouts._search')
                    </li>
                    <li>
                        <!-- Site Settings -->
                        <div class="settings-menu hidden-xs">
                            <a href="{{ route('admin.settings.index') }}" class="@if(Request::is('admin/settings*')) active @endif" title="Настройки сайта" data-toggle="tooltip" data-placement="bottom">
                                <i class="fa fa-cog"></i>
                            </a>
                        </div>
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
                    <a href="{{ route('admin.users.show', ['id' => Auth::user()->id]) }}">
                        <img src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ Auth::user()->login }}" title="{{ Auth::user()->login }}" class="img-circle img-thumbnail img-responsive">
                        <div class="user-status online"><i class="fa fa-circle"></i></div>
                    </a>
                </div>
                <h5>
                    <a href="{{ route('admin.users.show', ['id' => Auth::user()->id]) }}">
                        {{ Auth::user()->login }}
                    </a>
                </h5>
                <ul class="list-inline">
                    <li>
                        <a href="{{ route('admin.users.edit', ['id' => Auth::user()->id]) }}" title="Настройки профиля" data-toggle="tooltip">
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
                        <a href="{{ route('admin.index') }}" class="waves-effect @if(Route::is('admin.index')) active @endif">
                            <i class="zmdi zmdi-view-dashboard"></i>
                            <span>Главная</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="waves-effect @if(Request::is('admin/orders*')) active @endif">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Заказы</span>
                            @if($badge->countNewOrders)
                                <span class="label label-success pull-right">{{ $badge->countNewOrders }}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.calls.index') }}" class="waves-effect @if(Request::is('admin/calls*')) active @endif">
                            <i class="fa fa-phone"></i>
                            <span>Звонки</span>
                            @if($badge->countNewCalls)
                                <span class="label label-info pull-right">{{ $badge->countNewCalls }}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.letters.index') }}" class="waves-effect @if(Request::is('admin/letters*')) active @endif">
                            <i class="fa fa-envelope"></i>
                            <span>Письма</span>
                            @if($badge->countNewLetters)
                                <span class="label label-warning pull-right">{{ $badge->countNewLetters }}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reviews.index') }}" class="waves-effect @if(Request::is('admin/reviews*')) active @endif">
                            <i class="fa fa-comments"></i>
                            <span>Отзывы к товарам</span>
                            @if($badge->countNewProductReviews)
                                <span class="label label-pink pull-right">{{ $badge->countNewProductReviews }}</span>
                            @endif
                        </a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="{{ route('admin.shop_reviews.index') }}" class="waves-effect @if(Request::is('admin/shop_reviews*')) active @endif">--}}
                            {{--<i class="fa fa-comment"></i>--}}
                            {{--<span>Отзывы о магазине</span>--}}
                            {{--@if($badge->countNewReviews)--}}
                                {{--<span class="label label-purple pull-right">{{ $badge->countNewReviews }}</span>--}}
                            {{--@endif--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    <hr>

                    <li>
                        <a href="{{ route('admin.products.index') }}" class="waves-effect @if(Request::is('admin/products*')) active @endif">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Товары</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pages.index') }}" class="waves-effect @if(Request::is('admin/pages*')) active @endif">
                            <i class="fa fa-file"></i>
                            <span>Страницы</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="waves-effect @if(Request::is('admin/users*')) active @endif">
                            <i class="fa fa-users"></i>
                            <span>Пользователи</span>
                        </a>
                    </li>
                    <li class="visible-xs">
                        <a href="{{ route('admin.settings.index') }}" class="waves-effect @if(Request::is('admin/settings*')) active @endif">
                            <i class="fa fa-cogs"></i>
                            <span>Настройки сайта</span>
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
    @include('admin::notifications.notifications')

</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery-ui.min.js') }}"></script>
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

<script type="text/javascript">
    // Dropify options
    var dropifyOptions = {
        messages: {
            'default': 'Кликните или перетащите файл.',
            'replace': 'Кликните или перетащите файл для замены.',
            'remove': 'Удалить',
            'error': 'Ошибка.'
        },
        error: {
            'fileSize': 'Размер файла слишком большой (максимум 3Мб).'
        }
    };
</script>

@stack('scripts')

<!-- Toastr js -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('backend/js/jquery.core.js') }}"></script>
<script src="{{ asset('backend/js/jquery.app.js') }}"></script>


<script type="text/javascript">

    @if(Session::has('successMessage'))
        Command: toastr["success"]("{{ Session::get('successMessage') }}");
    @endif

    @if(Session::has('errorMessage'))
        Command: toastr["error"]("{{ Session::get('errorMessage') }}");
    @endif

    @if(Session::has('warningMessage'))
        Command: toastr["warning"]("{{ Session::get('warningMessage') }}");
    @endif

    @if(Session::has('infoMessage'))
        Command: toastr["info"]("{{ Session::get('infoMessage') }}");
    @endif

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

</body>
</html>