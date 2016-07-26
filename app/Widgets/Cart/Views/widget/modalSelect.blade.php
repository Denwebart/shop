<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="row">
    <div class="col-md-5 col-sm-5 col-xs-5">
        <img src="{{ $product->getImageUrl() }}" alt="{{ $product->image_alt }}" class="product-image">
    </div>

    <div class="col-md-7 col-sm-7 col-xs-7 align-left">

        <h4 class="m-t-10">Добавление товара в корзину</h4>

        @include('parts.productPropertySize', ['product' => $product])

        @include('parts.productPropertyColor', ['product' => $product])

        <div class="divider divider--xs"></div>
        <div class="align-center">
            <button class="btn btn--wd buy-link add-to-cart" data-product-id="{{ $product->id }}">
                <span class="icon icon-ecommerce"></span>
                <span class="product-preview__info__link__text text-uppercase">
                    <span class="hidden-md hidden-sm hidden-xs">Добавить в корзину</span>
                    <span class="hidden-lg">B корзину</span>
                </span>
            </button>
        </div>
    </div>
</div>