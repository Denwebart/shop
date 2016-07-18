<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta name="robots" content="@if(isset($siteSettings['meta']) && isset($siteSettings['meta']['robots']) && is_object($siteSettings['meta']['robots'])) {{ $siteSettings['meta']['robots']->value }} @else noindex,nofollow @endif">
    <title>@if($page->getMetaTitle()) {{ $page->getMetaTitle() }} @elseif(isset($siteSettings['meta']) && isset($siteSettings['meta']['title'])) {{ $siteSettings['meta']['title']->value }} @endif</title>
    <meta name="description" content="@if($page->getMetaDesc()) {{ $page->getMetaDesc() }} @elseif(isset($siteSettings['meta']) && isset($siteSettings['meta']['description'])) {{ $siteSettings['meta']['description']->value }} @endif">
    <meta name="keywords" content="@if($page->getMetaKey()) {{ $page->getMetaKey() }} @elseif(isset($siteSettings['meta']) && isset($siteSettings['meta']['keywords'])) {{ $siteSettings['meta']['keywords']->value }} @endif"/>

    @if(isset($siteSettings['meta']))
        @if(isset($siteSettings['meta']['author']) && is_object($siteSettings['meta']['author']))
            <meta name="author" lang="ru" content="{{ $siteSettings['meta']['author']->value }}">
        @endif
        @if(isset($siteSettings['meta']['copyright']) && is_object($siteSettings['meta']['copyright']))
            <meta name="copyright" lang="ru" content="{{ $siteSettings['meta']['copyright']->value }}" />
        @endif
    @endif

    <meta name="w1-verification" content="149973184407" />
    
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <link rel="shortcut icon" href="{{ asset('images/favicons/favicon.ico') }}">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Web Fonts  -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800,300italic,400italic,600italic,700italic,800italic&subset=latin,cyrillic-ext'
          rel='stylesheet' type='text/css'>
    <!-- Icon Fonts  -->
    <link rel="stylesheet" href="{{ asset('font/style.css') }}">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/waves/waves.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-select/bootstrap-select.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-colors-gold.css') }}">
    <!-- Custom Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700,700italic,500,500italic&subset=latin-ext,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>

    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/rs-plugin/css/settings.css') }}" media="screen"/>
    <!-- Head Libs -->

    <!--[if IE]>
    <!--<link rel="stylesheet" href="{{ asset('css/ie.css') }}">-->
    <![endif]-->
    <!--[if lte IE 8]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
    <![endif]-->

    @stack('styles')

    <!-- Modernizr -->
    <script src="{{ asset('vendor/modernizr/modernizr.js') }}"></script>
</head>
<body>
<div id="loader-wrapper" class="loader-off">
    <div id="loader"></div>
</div>
<div class="loader-wrapper loader-off">
    <div id="loader"></div>
</div>
<div class="wrapper">
    <!-- Header section -->
    <header class="header header--sticky"> <!-- header--sticky -->
        <div class="header-line hidden-xs">
            <div class="container">
                <div class="pull-left hidden-sm">
                    <div class="social-links social-links--colorize">
                        @include('parts.socialButtons')
                    </div>
                </div>
                <div class="pull-left">
                    <div class="currency-info">
                        <ul>
                            @if($courseUSD)
                                <li class="currency-info__item">
                                    <span>1$ = </span>
                                    {{ $courseUSD }}
                                    {{ Config::get('checkout.defaultCurrency.text') }}
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="user-links">
                        <ul>
                            {!! $menuWidget->main() !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-wd" id="navbar">
            <div class="container" style="position:relative">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" id="slide-nav"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <!--  Logo  -->
                    <a class="logo" href="{{ url('/') }}">
                        @if(isset($siteSettings['logo']))
                            @if(isset($siteSettings['logo']['main']) && is_object($siteSettings['logo']['main']))
                                <img class="logo-default" src="{{ $siteSettings['logo']['main']->getImageUrl() }}" alt=""/>
                            @endif
                            @if(isset($siteSettings['logo']['mobile']) && is_object($siteSettings['logo']['mobile']))
                                <img class="logo-mobile" src="{{ $siteSettings['logo']['mobile']->getImageUrl() }}" alt=""/>
                            @endif
                            @if(isset($siteSettings['logo']['transparent']) && is_object($siteSettings['logo']['transparent']))
                                <img class="logo-transparent" src="{{ $siteSettings['logo']['transparent']->getImageUrl() }}" alt=""/>
                            @endif
                        @endif
                        @if(isset($siteSettings['siteTitle']) && is_object($siteSettings['siteTitle']))
                            <span class="hidden-xs">
                                {{ $siteSettings['siteTitle']->value }}
                            </span>
                        @endif
                    </a>
                    <!-- End Logo -->
                </div>
                <div id="slidemenu">
                    <div class="slidemenu-close visible-xs">✕</div>
                    <ul class="hidden-lg hidden-md hidden-sm nav navbar-nav">
                        {!! $menuWidget->main() !!}
                    </ul>

                    <ul class="nav navbar-nav products-menu">
                        {!! $menuWidget->product() !!}

                        <!--<li>-->
                        <!--<a href="listing-open-filter.html" class="dropdown-toggle">-->
                        <!--<span class="link-name">Каталог</span>-->
                        <!--<span class="caret caret&#45;&#45;dots"></span>-->
                        <!--</a>-->
                        <!--<ul class="dropdown-menu animated fadeIn" role="menu">-->
                        <!--<li><a href="#">Пальто</a></li>-->
                        <!--<li><a href="#">Плащи</a></li>-->
                        <!--<li><a href="#">Куртки</a></li>-->
                        <!--<li><a href="#">Шубы</a></li>-->
                        <!--</ul>-->
                        <!--</li>-->
                    </ul>
                </div>

                <!-- Cart & Currency -->
                <div class="header__dropdowns">
                    <div class="header__currency pull-left">
                        <div class="dropdown">
                            @include('parts.switchCurrency', ['header' => true])
                        </div>
                    </div>
                    {!! $cartWidget->show() !!}

                    {!! $wishlistWidget->show() !!}
                </div>
                <!-- End Cart & Currency -->
            </div>
        </nav>
    </header>
    <!-- End Header section -->
    <div id="pageContent" class="page-content">
        @yield('content')
    </div>
    <footer class="footer">
        <div class="footer__links hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="h-links-list">
                            {!! $menuWidget->bottomLeft() !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="h-links-list text-right">
                            {!! $menuWidget->bottomRight() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__column-links">
            <div class="back-to-top">
                <a href="#top" class="btn btn--round btn--round--lg">
                    <span class="icon-arrow-up"></span>
                </a>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 hidden-xs hidden-sm">
                        <!--  Logo  -->
                        @if(isset($siteSettings['logo']) && isset($siteSettings['logo']['transparent']) && is_object($siteSettings['logo']['transparent']))
                            <a class="logo logo--footer" href="{{ url('/') }}">
                                <img src="{{ $siteSettings['logo']['transparent']->getImageUrl() }}" alt=""/>
                            </a>
                        @endif
                        <!-- End Logo -->
                        @if(isset($siteSettings['footerText']) && is_object($siteSettings['footerText']))
                            <p>{{ $siteSettings['footerText']->value }}</p>
                        @endif
                    </div>
                    <div class="col-sm-3 col-md-2">
                        {!! $menuWidget->info() !!}
                    </div>
                    <div class="col-sm-3 col-md-3 col-sm-push-6 col-md-push-4">
                        @include('parts.contactInfo')
                    </div>
                    <div class="col-sm-6 col-md-4 col-sm-pull-3 col-md-pull-3">
                        @if(isset($siteSettings['socialButtons']) && is_array($siteSettings['socialButtons']))
                            <h5 class="title text-uppercase">Мы в социальных сетях</h5>
                            <div class="v-links-list">
                                <div class="social-links social-links--colorize social-links--large">
                                    @include('parts.socialButtons')
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__subscribe">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        @include('parts.requestCall')
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__settings visible-xs">
            <div class="container text-center">
                <div class="dropdown pull-left">
                    @include('parts.switchCurrency')
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                @if(isset($siteSettings['copyright']) && is_object($siteSettings['copyright']))
                    <div class="copyright pull-left text-uppercase">
                        {{ $siteSettings['copyright']->value }}
                    </div>
                @endif
                <div class="created-by pull-right text-right">
                    Разработано студией
                    <a href="http://it-hill.com">
                        IT Hill
                        <img src="{{ asset('images/it-hill-logo.svg') }}" alt="Студия создания сайтов IT Hill">
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>

@yield('bottom')

<!-- Vendor -->
<!-- jQuery 1.12.3-->
<script src="{{ asset('vendor/jquery/jquery-1.12.3.js') }}"></script>
<!-- jQuery 1.11.2-->
{{--<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>--}}
<!-- Bootstrap 3-->
<script src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>
<!-- Specific Page Vendor -->
<script src="{{ asset('vendor/waves/waves.min.js') }}"></script>
<script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('vendor/parallax/jquery.parallax-1.1.3.js') }}"></script>
<script src="{{ asset('vendor/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendor/waypoints/sticky.min.js') }}"></script>
<script src="{{ asset('vendor/doubletaptogo/doubletaptogo.js') }}"></script>
<script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('vendor/countdown/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('vendor/countdown/jquery.countdown.min.js') }}"></script>
<!-- jQuery form validation -->
{{--<script src="{{ asset('vendor/form/jquery.form.js') }}"></script>--}}
{{--<script src="{{ asset('vendor/form/jquery.validate.min.js') }}"></script>--}}

@stack('scripts')

<!-- Custom -->
<script src="{{ asset('js/custom.min.js') }}"></script>
<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="{{ asset('vendor/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        var windowW = window.innerWidth || $j(window).width();
        var fullwidth;
        var fullscreen;

        if (windowW > 767) {
            fullwidth = "off";
            fullscreen = "on";
        } else {
            fullwidth = "on";
            fullscreen = "off";
        }

//        console.log(fullwidth);
//        console.log(fullscreen);

        jQuery('.tp-banner').show().revolution(
                {
                    dottedOverlay: "none",
                    delay: 16000,
                    startwidth: 1170,
                    startheight: 700,
                    hideThumbs: 200,
                    hideTimerBar: "on",

                    thumbWidth: 100,
                    thumbHeight: 50,
                    thumbAmount: 5,

                    navigationType: "none",
                    navigationArrows: "",
                    navigationStyle: "",

                    touchenabled: "on",
                    onHoverStop: "on",

                    swipe_velocity: 0.7,
                    swipe_min_touches: 1,
                    swipe_max_touches: 1,
                    drag_block_vertical: false,

                    parallax: "mouse",
                    parallaxBgFreeze: "on",
                    parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],

                    keyboardNavigation: "off",

                    navigationHAlign: "center",
                    navigationVAlign: "bottom",
                    navigationHOffset: 0,
                    navigationVOffset: 20,

                    soloArrowLeftHalign: "left",
                    soloArrowLeftValign: "center",
                    soloArrowLeftHOffset: 20,
                    soloArrowLeftVOffset: 0,

                    soloArrowRightHalign: "right",
                    soloArrowRightValign: "center",
                    soloArrowRightHOffset: 20,
                    soloArrowRightVOffset: 0,

                    shadow: 0,
                    fullWidth: fullwidth,
                    fullScreen: fullscreen,

                    spinner: "",

                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,

                    shuffle: "off",

                    autoHeight: "off",
                    forceFullWidth: "off",


                    hideThumbsOnMobile: "off",
                    hideNavDelayOnMobile: 1500,
                    hideBulletsOnMobile: "off",
                    hideArrowsOnMobile: "off",
                    hideThumbsUnderResolution: 0,

                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    startWithSlide: 0,
                    fullScreenOffsetContainer: ".header"
                });

    });	//ready

    function addPageLoader() {
        $j('body').removeClass('loaded').find('#loader-wrapper').removeClass('loader-off');
    }
    function removePageLoader() {
        $j('body').addClass('loaded').find('#loader-wrapper').addClass('loader-off');
    }

    function addLoader(hiddenContainerSelector) {
        $j('body').removeClass('loaded').find('.loader-wrapper').removeClass('loader-off');
        $j(hiddenContainerSelector).addClass('loading');
    }
    function removeLoader(hiddenContainerSelector) {
        $j('body').addClass('loaded').find('.loader-wrapper').addClass('loader-off');
        $j(hiddenContainerSelector).removeClass('loading');
    }

</script>
</body>
</html>