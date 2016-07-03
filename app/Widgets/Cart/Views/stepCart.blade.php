<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
@if(isset($cart['count']) && $cart['count'])
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="checkout-steps" class="row">
                <div class="checkout-steps__line step-1 col-xs-4 col-xs-offset-2"></div>
                <div class="checkout-steps__line step-2 col-xs-4"></div>
                <div style="animation-delay: 0.0s;" class="checkout-steps__step col-md-4 col-sm-4 col-xs-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.0s">
                    <a href="#" rel="nofollow" class="icon checkout-steps__step__icon icon-bag-alt change-step done active" data-step="{{ \App\Widgets\Cart\CartController::STEP_CART }}"></a>
                </div>
                <div style="animation-delay: 0.5s;" class="checkout-steps__step col-md-4 col-sm-4 col-xs-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.5s">
                    <a href="#" rel="nofollow" class="icon checkout-steps__step__icon icon-person change-step" data-step="{{ \App\Widgets\Cart\CartController::STEP_CHECKOUT }}"></a>
                </div>
                <div style="animation-delay: 1.0s;" class="checkout-steps__step col-md-4 col-sm-4 col-xs-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="1.0s">
                    <a href="#" rel="nofollow" class="icon checkout-steps__step__icon icon-money change-step" data-step="{{ \App\Widgets\Cart\CartController::STEP_PAYMENT }}"></a>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="row">
    @if($page->title)
        <h2 class="text-uppercase align-center">{{ $page->title }}</h2>
    @endif
    <div class="col-md-8 col-md-offset-2">
        <div class="cart-products cart-products-table">
            @include('widget.cart::productsTable')
        </div>
    </div>
</div>