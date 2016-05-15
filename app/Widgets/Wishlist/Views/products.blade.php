<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

{{ var_dump(\Cookie::get('wishlist')) }}

@if(count($products))
    <ul>
        @foreach($products as $key => $item)
            <li class='shopping-cart__item'>
                <div class="shopping-cart__item__image pull-left">
                    <a href="{{ $item['product']->getUrl() }}">
                        <img src="{{ $item['product']->getImageUrl('mini') }}" alt="{{ $item['product']->image_alt }}"/>
                    </a>
                </div>
                <div class="shopping-cart__item__info">
                    <div class="shopping-cart__item__info__title">
                        <a href="{{ $item['product']->getUrl() }}">
                            {{ $item['product']->title }}
                        </a>
                        <br>
                        Дата добавления:
                        {{ \App\Helpers\Date::getRelative($item['added_at']) }}
                    </div>
                    <div class="shopping-cart__item__info__price">
                        {{ \App\Helpers\Str::priceFormat($item['product']->price) }}
                    </div>
                    <div class="shopping-cart__item__info__delete">
                        <a href="#" class="icon icon-clear remove-from-wishlist" data-product-id="{{ $item['product']->id }}"></a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <div class="align-center m-t-5">
        Список желаний пуст.
    </div>
@endif