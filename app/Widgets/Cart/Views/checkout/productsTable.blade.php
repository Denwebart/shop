<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($cart['products']))
    <ul>
        @foreach($cart['products'] as $key => $item)
            <li class="shopping-cart__item @if(!$item['product']) bg-muted @endif">
                <div class="shopping-cart__item__image pull-left">
                    @if($item['product'])
                        <a href="{{ $item['product']->getUrl() }}">
                            <img src="{{ $item['product']->getImageUrl('mini') }}" alt="{{ $item['product']->image_alt }}"/>
                        </a>
                    @else
                        <img src="{{ asset('images/product-default-image.jpg') }}" alt="Нет изображения"/>
                    @endif
                </div>
                <div class="shopping-cart__item__info">
                    <div class="shopping-cart__item__info__title">
                        @if($item['product'])
                            <a href="{{ $item['product']->getUrl() }}">
                                {{ $item['product']->title }}
                                ({{ $item['product']->vendor_code }})
                            </a>
                        @else
                            <span class="text-danger text-uppercase">Товар был удален с сайта.</span>
                        @endif
                    </div>

                    @if(isset($item['options']['color']))
                        <div class="shopping-cart__item__info__option">Цвет: {{ $item['options']['color'] }}</div>
                    @endif
                    @if(isset($item['options']['size']))
                        <div class="shopping-cart__item__info__option">Размер: {{ $item['options']['size'] }}</div>
                    @endif

                    @if($item['product'])
                        <div class="shopping-cart__item__info__price">
                            {{ \App\Helpers\Str::priceFormat($item['product']->getPrice() * $item['quantity']) }}
                        </div>
                        <div class="shopping-cart__item__info__qty">
                            <div class="input-group-qty pull-left">
                                <span class="pull-left m-r-5 m-t-10">Кол-во: </span>
                                <input type="text" name="quantity" class="input-number change-quantity input--wd input-qty pull-left" value="{{ $item['quantity'] }}" data-old-value="{{ $item['quantity'] or 0 }}" min="1" max="1000" data-product-id="{{ $item['product']->id }}" data-product-key="{{ $key }}">
                                <span class="pull-left btn-number-container">
                                    <button type="button" class="btn btn-number btn-number--plus" data-type="plus" data-field="quantity" data-product-id="{{ $item['product']->id }}" data-product-key="{{ $key }}">+</button>
                                    <button type="button" class="btn btn-number btn-number--minus" @if($item['quantity'] <= 1) disabled="disabled" @endif data-type="minus" data-field="quantity" data-product-id="{{ $item['product']->id }}" data-product-key="{{ $key }}">&#8211;</button>
                                </span>
                            </div>
                        </div>
                    @endif
                    <div class="shopping-cart__item__info__delete">
                        <a href="#" class="icon icon-clear remove-from-cart" data-product-key="{{ $key }}"></a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="shopping-cart__bottom">
        <div class="pull-left m-b-10">
            Товаров в корзине:
            <span class="shopping-cart__count">
                <span class="cart-count">
                    {{ $cart['count'] }}
                </span>
            </span>
        </div>
        <div class="pull-right m-b-10">
            Общая сумма заказа:
            <span class="shopping-cart__total">
                <span class="total-price">
                    {{ \App\Helpers\Str::priceFormat($cart['total_price']) }}
                </span>
            </span>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="shopping-cart__bottom">
        <div class="row m-t-20">
            @if($cart['total_price'])
                <div class="pull-right">
                    <a href="#" class="btn btn--wd text-uppercase change-step" data-step="{{ \App\Widgets\Cart\CartController::STEP_CHECKOUT }}">
                        Оформить заказ
                    </a>
                </div>
            @endif
        </div>
    </div>
@else
    <div class="align-center m-t-5">
        Корзина пуста.
    </div>
@endif