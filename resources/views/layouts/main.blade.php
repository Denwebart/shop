<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <title>Интернет-магазин верхней одежды</title>
    <meta name="description" content="Интернет-магазин верхней одежды">
    <meta name="keywords" content="HTML5 Template"/>
    <meta name="author" content="it-hill.com">
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

    <!-- Modernizr -->
    <script src="{{ asset('vendor/modernizr/modernizr.js') }}"></script>
</head>
<body>

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
                            <li class="currency-info__item"><span>$ USD:</span> {{ $courseUSD }} руб.</li>
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
                        <img class="logo-default" src="images/logo.png" alt=""/>
                        <img class="logo-mobile" src="images/logo-mobile.png" alt=""/>
                        <img class="logo-transparent" src="images/logo-transparent.png" alt=""/>
                        <span>Интернет-магазин женской верхней одежды</span>
                    </a>
                    <!-- End Logo -->
                </div>
                <div id="slidemenu">
                    <div class="slidemenu-close visible-xs">✕</div>
                    <ul class="hidden-lg hidden-md hidden-sm nav navbar-nav">
                        {!! $menuWidget->main() !!}
                    </ul>

                    <ul class="nav navbar-nav">
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
                            <a href="#" class="btn dropdown-toggle btn--links--dropdown header__dropdowns__button" data-toggle="dropdown" aria-expanded="false">
                                <span class="header__dropdowns__button__text">Цены в: </span>
                                            <span class="header__dropdowns__button__symbol">
                                                <span class="currency__item__symbol">₽</span>
                                                <span class="currency__item__title">(рублях)</span>
                                            </span>
                                <span class="caret caret--dots"></span>
                            </a>
                            <ul class="dropdown-menu animated fadeIn" role="menu">
                                <li class="currency__item currency__item--active">
                                    <a href="#">
                                        <span class="currency__item__symbol">₽</span>
                                        <span class="currency__item__title">(рублях)</span>
                                    </a>
                                </li>
                                <li class="currency__item">
                                    <a href="#">
                                        <span class="currency__item__symbol">$</span>
                                        <span class="currency__item__title">(долларах)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="header__cart pull-left">
                        <span class="header__cart__indicator hidden-xs hidden-sm hidden-md hidden-lg">
                            22 000 руб.
                        </span>
                        <div class="dropdown pull-right">
                            <a href="#" class="btn dropdown-toggle btn--links--dropdown header__cart__button header__dropdowns__button" data-toggle="dropdown">
                                <span class="icon icon-bag-alt"></span>
                                <span class="badge badge--menu">2</span>
                            </a>
                            <div class="dropdown-menu animated fadeIn shopping-cart" role="menu">
                                <div class="shopping-cart__top text-uppercase">Корзина (2)</div>
                                <ul>
                                    <li class='shopping-cart__item'>
                                        <div class="shopping-cart__item__image pull-left">
                                            <a href="product.html">
                                                <img src="images/7-sky-blue.JPG" alt=""/>
                                            </a>
                                        </div>
                                        <div class="shopping-cart__item__info">
                                            <div class="shopping-cart__item__info__title">
                                                <a href="product.html">Элегантное пальто демисезонное</a>
                                            </div>
                                            <div class="shopping-cart__item__info__option">Цвет: Голубой</div>
                                            <div class="shopping-cart__item__info__option">Размер: 42-46</div>
                                            <div class="shopping-cart__item__info__price">5 000 руб.</div>
                                            <div class="shopping-cart__item__info__qty">Кол-во: 1</div>
                                            <div class="shopping-cart__item__info__delete">
                                                <a href="#" class="icon icon-clear"></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class='shopping-cart__item'>
                                        <div class="shopping-cart__item__image pull-left">
                                            <a href="product.html">
                                                <img src="images/2-black.JPG" alt=""/>
                                            </a>
                                        </div>
                                        <div class="shopping-cart__item__info">
                                            <div class="shopping-cart__item__info__title">
                                                <a href="product.html">Пальто демисезонное</a>
                                            </div>
                                            <div class="shopping-cart__item__info__option">Цвет: Черный</div>
                                            <div class="shopping-cart__item__info__option">Размер: 42-46</div>
                                            <div class="shopping-cart__item__info__price">15 000 руб.</div>
                                            <div class="shopping-cart__item__info__qty">Кол-во: 1</div>
                                            <div class="shopping-cart__item__info__delete">
                                                <a href="#" class="icon icon-clear"></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart__bottom">
                                    <div class="pull-left">
                                        Всего:
                                        <span class="shopping-cart__total">22 000 руб.</span>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn--wd text-uppercase">Оформить заказ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <ul>
                                {!! $menuWidget->bottomLeft() !!}
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="h-links-list text-right">
                            <ul>
                                {!! $menuWidget->bottomRight() !!}
                            </ul>
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
                        <a class="logo logo--footer" href="{{ url('/') }}">
                            <img src="images/logo-transparent.png" alt=""/>
                            <span class="m-t-10">Интернет-магазин женской верхней одежды</span>
                        </a>
                        <!-- End Logo -->
                        <p>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты.</p>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <h5 class="title text-uppercase">Информация</h5>
                        <div class="v-links-list">
                            <ul>
                                {!! $menuWidget->info() !!}
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3 col-sm-push-6 col-md-push-4">
                        @include('parts.contactInfo')
                    </div>
                    <div class="col-sm-6 col-md-4 col-sm-pull-3 col-md-pull-3">
                        <h5 class="title text-uppercase">Мы в социальных сетях</h5>
                        <div class="v-links-list">
                            <div class="social-links social-links--colorize social-links--large">
                                @include('parts.socialButtons')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__settings visible-xs">
            <div class="container text-center">
                <div class="dropdown pull-left">
                    <a href="#" class="btn dropdown-toggle btn--links--dropdown header__dropdowns__button" data-toggle="dropdown" aria-expanded="false">
                        <span class="header__dropdowns__button__text">Цены в: </span>
                        <span class="header__dropdowns__button__symbol">
                            <span class="currency__item__symbol">₽</span>
                            <span class="currency__item__title">(рублях)</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeIn" role="menu">
                        <li class="currency__item currency__item--active">
                            <a href="#">
                                <span class="currency__item__symbol">₽</span>
                                <span class="currency__item__title">(рублях)</span>
                            </a>
                        </li>
                        <li class="currency__item">
                            <a href="#">
                                <span class="currency__item__symbol">$</span>
                                <span class="currency__item__title">(долларах)</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="copyright pull-left text-uppercase">
                    © 2016 Все права защищены.
                </div>
                <div class="created-by pull-right text-right">
                    Разработано студией
                    <a href="http://it-hill.com">
                        IT Hill
                        <img src="images/it-hill-logo.svg" alt="Студия создания сайтов IT Hill">
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>

<div class="modal fade bs-example-modal-sm" role="dialog" id="modalAddToCart">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <button type="button" class="close icon-clear" data-dismiss="modal"></button>
            <div class="text-center">
                <div class="divider divider--xs"></div>
                <p>Продукт успешно добавлен в корзину!</p>
                <div class="divider divider--xs"></div>
                <a href="#" class="btn btn--wd">Посмотреть корзину</a>
                <div class="divider divider--xs"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" role="dialog" id="modalAddToWishlist">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <button type="button" class="close icon-clear" data-dismiss="modal"></button>
            <div class="text-center">
                <div class="divider divider--xs"></div>
                <div class="loading">
                    <div class="divider divider--sm"></div>
                    <div class="loader">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </div>
                <p class="success">Продукт успешно добавлен в Ваш список желаний! </p>
                <div class="divider divider--xs"></div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor -->
<!-- jQuery 1.10.1-->
<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
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
<script src="{{ asset('vendor/form/jquery.form.js') }}"></script>
<script src="{{ asset('vendor/form/jquery.validate.min.js') }}"></script>
<!-- Custom -->
<script src="{{ asset('js/custom.js') }}"></script>
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

</script>
</body>
</html>