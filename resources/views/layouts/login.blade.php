<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">

    <!-- App title -->
    <title>@if(isset($title)) {{ $title }} - @endif Административная панель магазина</title>

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
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">

    <div class="text-center">
        <a href="{{ url('/') }}" class="logo">
            @if(isset($siteSettings['logo']))
                @if(isset($siteSettings['logo']['main']) && is_object($siteSettings['logo']['main']))
                    <img class="logo-default" src="{{ asset('images/'. $siteSettings['logo']['main']->value) }}" alt=""/>
                @endif
            @endif
        </a>
        @if(isset($siteSettings['siteTitle']) && is_object($siteSettings['siteTitle']))
            <h5 class="text-muted m-t-0 font-600">
                {{ $siteSettings['siteTitle']->value }}
            </h5>
        @endif
    </div>

    @yield('content')

</div>
<!-- end wrapper page -->

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
<script src="{{ asset('backend/js/wow.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('backend/js/jquery.scrollTo.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('backend/js/jquery.core.js') }}"></script>
<script src="{{ asset('backend/js/jquery.app.js') }}"></script>

</body>
</html>