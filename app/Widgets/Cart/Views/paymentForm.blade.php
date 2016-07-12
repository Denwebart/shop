<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="row">
    @if($page->title)
        <h2 class="text-uppercase align-center">{{ $page->title }}</h2>
    @endif
    <div class="col-md-8 col-md-offset-2">
        <div class="cart-products cart-products-table">
            {!! $data['form'] !!}
        </div>
    </div>
</div>