<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<span class="header__cart__indicator hidden-xs hidden-sm hidden-md hidden-lg">
    22 000 руб.
</span>
<div class="dropdown pull-right">
    <a href="#" class="btn dropdown-toggle btn--links--dropdown header__cart__button header__dropdowns__button" data-toggle="dropdown">
        <span class="icon icon-bag-alt"></span>
        <span class="badge badge--menu count-cart-items @if(!count($products)) hidden @endif">
            {{ count($products) }}
        </span>
    </a>
    <div class="dropdown-menu animated fadeIn shopping-cart" role="menu">
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
    </div>
</div>