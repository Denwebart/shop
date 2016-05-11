<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($cart['products']))
    <div class="shopping-cart__top text-uppercase">
        Корзина (<span class="count-cart-items">{{ count($cart['products']) }}</span>)
    </div>
    <ul>
        @foreach($cart['products'] as $key => $item)
            <li class='shopping-cart__item'>
                <div class="shopping-cart__item__image pull-left">
                    <a href="{{ $item['product']->getUrl() }}">
                        <img src="{{ $item['product']->getImageUrl('mini') }}" alt="{{ $item['product']->image_alt }}"/>
                    </a>
                </div>
                <div class="shopping-cart__item__info">
                    <div class="shopping-cart__item__info__title">
                        <a href="{{ $item['product']->getUrl() }}">
                            {{ $item['product']->title }}
                        </a>
                    </div>
                    {{--<div class="shopping-cart__item__info__option">Цвет: Голубой</div>--}}
                    {{--<div class="shopping-cart__item__info__option">Размер: 42-46</div>--}}
                    <div class="shopping-cart__item__info__price">
                        {{ \App\Helpers\Str::priceFormat($item['product']->price) }}
                    </div>
                    <div class="shopping-cart__item__info__qty">Кол-во: 1</div>
                    <div class="shopping-cart__item__info__delete">
                        <a href="#" class="icon icon-clear remove-from-cart" data-product-id="{{ $item['product']->id }}" data-product-key="{{ $key }}"></a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="shopping-cart__bottom">
        <div class="pull-left">
            Всего:
            <span class="shopping-cart__total">
                <span class="total-price">
                    {{ \App\Helpers\Str::priceFormat($cart['total_price']) }}
                </span>
            </span>
        </div>
        <div class="pull-right">
            <a href="{{ route('cart.index') }}" class="btn btn--wd text-uppercase">
                Оформить заказ
            </a>
        </div>
    </div>
@else
    <div class="align-center m-t-5">
        Корзина пуста.
    </div>
@endif