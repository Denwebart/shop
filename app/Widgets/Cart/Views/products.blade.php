<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($cart['products']))
    <div class="shopping-cart__top text-uppercase">
        Корзина (<span class="count-cart-items">{{ $cart['count'] }}</span>)
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
                        {{ \App\Helpers\Str::priceFormat($item['product']->getPrice() * $item['quantity']) }}
                    </div>
                    <div class="shopping-cart__item__info__qty">
                        <div class="input-group-qty pull-left">
                            <span class="pull-left m-r-5">Кол-во: </span>
                            <input type="text" name="quantity" class="input-number input--wd input-qty pull-left" value="{{ $item['quantity'] }}" min="1" max="100">
                            <span class="pull-left btn-number-container">
                                <button type="button" class="btn btn-number btn-number--plus" data-type="plus" data-field="quantity">+</button>
                                <button type="button" class="btn btn-number btn-number--minus" @if($item['quantity'] <= 1) disabled="disabled" @endif data-type="minus" data-field="quantity">&#8211;</button>
                            </span>
                        </div>
                    </div>
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