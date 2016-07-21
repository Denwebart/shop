<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@include('parts.productPropertySize', ['product' => $product])

@include('parts.productPropertyColor', ['product' => $product])

<button class="btn btn--wd buy-link add-to-cart" data-product-id="{{ $product->id }}">
    <span class="icon icon-ecommerce"></span>
    <span class="product-preview__info__link__text text-uppercase">
        <span class="hidden-md hidden-sm hidden-xs">Добавить в корзину</span>
        <span class="hidden-lg">B корзину</span>
    </span>
</button>
