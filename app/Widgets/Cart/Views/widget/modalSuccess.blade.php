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

    <div class="col-md-7 col-sm-7 col-xs-7 align-center">
        <h4 class="m-t-10"></h4>

        <div class="divider divider--xs"></div>
        <a href="{{ route('cart.index') }}" class="btn btn--wd">Посмотреть корзину</a>
    </div>
</div>