<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($products))
    <ul>
        @foreach($products as $key => $item)
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
                            </a>
                        @else
                            <span class="text-danger text-uppercase">Товар был удален с сайта.</span>
                        @endif
                        <div class="m-t-10">
                            Дата добавления:
                            {{ \App\Helpers\Date::getRelative($item['added_at']) }}
                        </div>
                    </div>
                    @if($item['product'])
                        <div class="shopping-cart__item__info__price">
                            {{ \App\Helpers\Str::priceFormat($item['product']->price) }}
                        </div>
                    @endif
                    <div class="shopping-cart__item__info__delete">
                        <a href="#" class="icon icon-clear remove-from-wishlist" data-product-key="{{ $key }}"></a>
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