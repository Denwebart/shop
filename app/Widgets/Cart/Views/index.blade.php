<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
@extends('layouts.main')

@section('content')
<!-- Breadcrumb section -->

<section class="breadcrumbs  hidden-xs">
    <div class="container">
        @include('parts.breadcrumbs')
    </div>
</section>

<!-- Content section -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($page->title)
                    <h2 class="text-uppercase">{{ $page->title }}</h2>
                @endif

                <div class="cart-products cart-products-table">
                    @include('widget.cart::productsTable')
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content content--fill bottom-null">
    <div class="container">
        <h2 class="text-center">
            Что-нибудь о том, как оформить заказ.
        </h2>
        <div class="row">
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0.5s">
                <h5 class="title text-uppercase">
                    <span class="dropcap custom-color">1.</span>
                    Далеко за горами живут рыбные тексты.
                </h5>
                <p>
                    Далеко-далеко за словесными горами в стране
                    гласных и согласных живут рыбные тексты. Вдали
                    от всех живут они в буквенных домах на берегу
                    Семантика большого языкового океана. Маленький
                    ручеек Даль журчит по всей стране и обеспечивает
                    ее всеми необходимыми правилами. Эта парадигматическая
                    страна.
                </p>
            </div>
            <div class="divider divider--sm visible-xs"></div>
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0s">
                <h5 class="title text-uppercase">
                    <span class="dropcap custom-color">2.</span>
                    Вдали от всех живут они в буквенных домах.
                </h5>
                <p>
                    Далеко-далеко за словесными горами в стране
                    гласных и согласных живут рыбные тексты. Вдали
                    от всех живут они в буквенных домах на берегу
                    Семантика большого языкового океана. Маленький
                    ручеек Даль журчит по всей стране и обеспечивает
                    ее всеми необходимыми правилами. Эта парадигматическая
                    страна.
                </p>
            </div>
            <div class="divider divider--sm visible-xs"></div>
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0.5s">
                <h5 class="title text-uppercase">
                    <span class="dropcap custom-color">3.</span>
                    Маленький ручеек Даль журчит по всей стране.
                </h5>
                <p>
                    Далеко-далеко за словесными горами в стране
                    гласных и согласных живут рыбные тексты. Вдали
                    от всех живут они в буквенных домах на берегу
                    Семантика большого языкового океана. Маленький
                    ручеек Даль журчит по всей стране и обеспечивает
                    ее всеми необходимыми правилами. Эта парадигматическая
                    страна.
                </p>
            </div>
        </div>
        <div class="divider divider--sm"></div>
    </div>
</section>
<!-- End Content section -->
@endsection