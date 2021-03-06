<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
@extends('layouts.main')

@section('content')
<!-- Breadcrumb section -->

<div class="breadcrumbs  hidden-xs">
    <div class="container">
        @include('parts.breadcrumbs')
    </div>
</div>

<!-- Content section -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($page->title)
                    <h2 class="text-uppercase">{{ $page->title }}</h2>
                @endif

                <div class="wishlist-products">
                    @include('widget.wishlist::products')
                </div>
            </div>
        </div>
    </div>
</section>

{!! $viewed->show() !!}
<!-- End Content section -->
@endsection