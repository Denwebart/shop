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
            <div class="col-md-8 col-md-offset-2">
                <div id="checkout-steps" class="row">
                    <div style="animation-delay: 0.0s;" class="checkout-steps__step col-md-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.0s">
                        <a href="{{ route('cart.index') }}" class="icon checkout-steps__step__icon icon-bag-alt active"></a>
                    </div>
                    <div style="animation-delay: 0.5s;" class="checkout-steps__step col-md-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.5s">
                        <a href="{{ route('cart.checkout') }}" class="icon checkout-steps__step__icon icon-person"></a>
                    </div>
                    <div style="animation-delay: 1.0s;" class="checkout-steps__step col-md-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="1.0s">
                        <a href="{{ route('cart.payment') }}" class="icon checkout-steps__step__icon icon-money"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if($page->title)
                <h2 class="text-uppercase align-center">{{ $page->title }}</h2>
            @endif
            <div class="col-md-9">
                <div class="cart-products cart-products-table">
                    @include('widget.cart::productsTable')
                </div>
            </div>
            <div class="col-md-3">
                Общая стоимость
            </div>
        </div>
    </div>
</section>
<section class="content content--fill bottom-null">
    <div class="container">
        <h2 class="text-center">
            Как оформить заказ?
        </h2>
        <div class="row">
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0.5s">
                <span class="dropcap custom-color m-r-10">
                    <i class="icon icon-bag-alt"></i>
                </span>
                <h5 class="title text-uppercase m-t-10">
                    Проверьте детали заказа
                </h5>
                <div class="clearfix"></div>
                <p>
                    Проверьте, правильно ли выбран размер и цвет желаемого товара.
                    <br>
                    Проверьте количество выбранных товаров и сумму покупки,
                    так как в дальнейшем это нельзя будет изменить.
                </p>
            </div>
            <div class="divider divider--sm visible-xs"></div>
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0s">
                <span class="dropcap custom-color m-r-10">
                    <i class="icon icon-person"></i>
                </span>
                <h5 class="title text-uppercase m-t-10">
                    Заполнение данные о себе
                </h5>
                <div class="clearfix"></div>
                <p>
                    Заполните данные о себе, правильно указав имя и телефон.
                    Если телефон указан неверно &mdash; заказ будет отменен.
                    <br>
                    Выберите способ доставки, обязательно указав адрес.
                </p>
            </div>
            <div class="divider divider--sm visible-xs"></div>
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0.5s">
                <span class="dropcap custom-color m-r-10">
                    <i class="icon icon-money"></i>
                </span>
                <h5 class="title text-uppercase m-t-10">
                    Оплатите заказ
                </h5>
                <div class="clearfix"></div>
                <p>
                    Выберите способ оплаты и оплатите товар.
                    Оплата заказа доступна с помощью банковских карт
                    популярных международных платёжных систем: VISA, MasterCard, Maestro.
                </p>
            </div>
        </div>
        <div class="divider divider--sm"></div>
    </div>
</section>
<!-- End Content section -->
@endsection