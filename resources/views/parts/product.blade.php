<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
<div class="product-preview-wrapper">
    <div class="product-preview open">
        <div class="product-preview__image">
            <a href="{{ $item->getUrl() }}">
                <img src="{{ $item->getImageUrl() }}" alt=""/>
            </a>
            {{--<div class="product-preview__label product-preview__label--left product-preview__label--new">--}}
            {{--<span>новое</span>--}}
            {{--</div>--}}
            {{--<div class="product-preview__label product-preview__label--right product-preview__label--sale">--}}
            {{--<span>скидка<br>-10%</span>--}}
            {{--</div>--}}
            {{--<div class="countdown_box">--}}
            {{--<div class="countdown_inner">--}}
            {{--<div class="title">специальная цена:</div>--}}
            {{--<div id="countdown3"></div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="product-preview__info text-center">
            <div class="product-preview__info__btns">
                <button class="btn btn--round add-to-cart" data-product-id="{{ $item->id }}">
                    <span class="icon-ecommerce"></span>
                </button>
            </div>
            <div class="product-preview__info__title">
                <h2>
                    <a href="{{ $item->getUrl() }}">
                        {{ $item->title }}
                    </a>
                </h2>
            </div>
            {{--<ul class="options-swatch options-swatch--color">--}}
            {{--<li>--}}
            {{--<a href="#">--}}
            {{--<span class="swatch-label">--}}
            {{--<img src="images/colors/blue.png" width="10" height="10" alt=""/>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="#">--}}
            {{--<span class="swatch-label">--}}
            {{--<img src="images/colors/yellow.png" width="10" height="10" alt=""/>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="#">--}}
            {{--<span class="swatch-label">--}}
            {{--<img src="images/colors/green.png" width="10" height="10" alt=""/>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="#">--}}
            {{--<span class="swatch-label">--}}
            {{--<img src="images/colors/dark-grey.png" width="10" height="10" alt=""/>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="#">--}}
            {{--<span class="swatch-label">--}}
            {{--<img src="images/colors/grey.png" width="10" height="10" alt=""/>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="#">--}}
            {{--<span class="swatch-label">--}}
            {{--<img src="images/colors/red.png" width="10" height="10" alt=""/>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="#">--}}
            {{--<span class="swatch-label">--}}
            {{--<img src="images/colors/white.png" width="10" height="10" alt=""/>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            <div class="price-box ">
                <span class="price-box__new">{{ \App\Helpers\Str::priceFormat($item->getPrice()) }}</span>
                {{--<span class="price-box__old">6000 руб.</span>--}}
            </div>
            @if($item->getIntrotext())
                <div class="product-preview__info__description">
                    {!! $item->getIntrotext() !!}
                </div>
            @endif
            <div class="product-preview__info__link">
                <a href="#" class="add-to-wishlist @if($item->inWishlist()) active @endif" data-product-id="{{ $item->id }}" rel="nofollow">
                    <span class="icon icon-favorite"></span>
                    <span class="product-preview__info__link__text dashed-bottom">
                        Добавить в список желаний
                    </span>
                </a>
                <button class="btn btn--wd buy-link add-to-cart" data-product-id="{{ $item->id }}">
                    <span class="icon icon-ecommerce"></span>
                    <span class="product-preview__info__link__text text-uppercase">
                        Добавить в корзину
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>