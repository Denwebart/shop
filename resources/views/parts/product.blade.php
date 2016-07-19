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
            @if($item->published_at > \Carbon\Carbon::now()->subDay(7)->toDateTimeString())
                <div class="product-preview__label product-preview__label--left product-preview__label--new">
                    <span>Новое</span>
                </div>
            @endif
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
            <ul class="options-swatch options-swatch--color">
                @foreach($item->propertyColor as $color)
                    <li @if(in_array($color->value, explode(',', \Request::get($color->property->title)))) class="active" @endif>
                        <a href="{{ $item->getUrl([$color->property->title => $color->value]) }}">
                            <span class="swatch-label color-icon color tooltip-link" title="{{ $color->value }}" style="background: {{ $color->additional_value or '#ffffff' }}"></span>
                        </a>
                    </li>
                @endforeach
            </ul>
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
                        <span class="hidden-md hidden-sm hidden-xs">Добавить в список желаний</span>
                        <span class="hidden-lg">B список желаний</span>
                    </span>
                </a>
                <button class="btn btn--wd buy-link add-to-cart" data-product-id="{{ $item->id }}">
                    <span class="icon icon-ecommerce"></span>
                    <span class="product-preview__info__link__text text-uppercase">
                        <span class="hidden-md hidden-sm hidden-xs">Добавить в корзину</span>
                        <span class="hidden-lg">B корзину</span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>