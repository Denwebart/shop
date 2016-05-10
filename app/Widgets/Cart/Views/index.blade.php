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

                @if(count($products))
                    <div class="shopping-cart__top text-uppercase">
                        Корзина (<span class="count-cart-items">{{ count($products) }}</span>)
                    </div>
                    <ul>
                        @foreach($products as $product)
                            <li class='shopping-cart__item'>
                                <div class="shopping-cart__item__image pull-left">
                                    <a href="{{ $product->getUrl() }}">
                                        <img src="{{ $product->getImageUrl('mini') }}" alt="{{ $product->image_alt }}"/>
                                    </a>
                                </div>
                                <div class="shopping-cart__item__info">
                                    <div class="shopping-cart__item__info__title">
                                        <a href="{{ $product->getUrl() }}">
                                            {{ $product->title }}
                                        </a>
                                    </div>
                                    {{--<div class="shopping-cart__item__info__option">Цвет: Голубой</div>--}}
                                    {{--<div class="shopping-cart__item__info__option">Размер: 42-46</div>--}}
                                    <div class="shopping-cart__item__info__price">
                                        {{ \App\Helpers\Str::priceFormat($product->price) }}
                                    </div>
                                    <div class="shopping-cart__item__info__qty">Кол-во: 1</div>
                                    <div class="shopping-cart__item__info__delete">
                                        <a href="#" class="icon icon-clear"></a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
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
                @else
                    <div class="align-center m-t-5">
                        Корзина пуста.
                    </div>
                @endif
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

@section('bottom')
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
@endsection

@push('scripts')
    <script type="text/javascript">
        jQuery(function($j) {

            "use strict";

            $j(document).on('click', '.add-to-cart', function(e){
                e.preventDefault();
                var $button = $j(this),
                    productId = $j(this).data('productId');

                $button.addClass('btn--wait');
                $j.ajax({
                    url: "{{ route('cart.add') }}",
                    dataType: "json",
                    type: "POST",
                    data: {'id': productId},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success){
                            $button.removeClass('btn--wait');
                            $j('#modalAddToCart').modal("toggle");
                            $j('#cart').html(response.cartHtml);
                        }
                    }
                });
            });
        });

    </script>
@endpush