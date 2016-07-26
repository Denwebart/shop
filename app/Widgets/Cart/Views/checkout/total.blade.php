<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="shopping-cart__bottom">
    <div class="pull-left m-b-10">
        Товаров в корзине:
        <span class="shopping-cart__count">
            <span class="cart-count">
                {{ $cart['count'] }}
            </span>
        </span>
    </div>

    {{-- Всего --}}
    <div class="pull-right m-b-10">
        Всего:
        <span class="price products-price">
            {{ \App\Helpers\Str::priceFormat($cart['total_price']) }}
        </span>
    </div>
    <div class="clearfix"></div>

    {{-- Стоимость доставки --}}
    <div class="pull-right m-b-10">
        Стоимость доставки:
        <span class="price delivery-price">
            @if(isset($cart['delivery_price']))
                {{ \App\Helpers\Str::priceFormat($cart['delivery_price']) }}
            @else
                -
            @endif
        </span>
    </div>
    <div class="clearfix"></div>
    {{-- Общая сумма --}}
    <div class="pull-right m-b-10">
        Общая сумма заказа:
        <span class="shopping-cart__total">
            <span class="price total-price">
                {{ \App\Helpers\Str::priceFormat($cart['total_price'] + (isset($cart['delivery_price']) ? $cart['delivery_price'] : 0)) }}
            </span>
        </span>
    </div>
</div>
<div class="clearfix"></div>