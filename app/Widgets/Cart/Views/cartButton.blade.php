<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="dropdown pull-right">
    <a href="#" class="btn dropdown-toggle btn--links--dropdown header__cart__button header__dropdowns__button" data-toggle="dropdown" title="Корзина" data-toggle="tooltip">
        <span class="icon icon-bag-alt"></span>
        <span class="badge badge--menu count-cart-items @if(!count($cart['products'])) hidden @endif">
            {{ $cart['count'] }}
        </span>
    </a>
    <div class="dropdown-menu animated fadeIn shopping-cart cart-products cart-products-widget" role="menu">
        @include('widget.cart::productsWidget')
    </div>
</div>