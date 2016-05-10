<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
<div id="cart" class="header__cart pull-left">
    <span class="header__cart__indicator hidden-xs hidden-sm hidden-md hidden-lg">
        22 000 руб.
    </span>
    <div class="dropdown pull-right">
        <a href="#" class="btn dropdown-toggle btn--links--dropdown header__cart__button header__dropdowns__button" data-toggle="dropdown">
            <span class="icon icon-bag-alt"></span>
            <span class="badge badge--menu count-cart-items @if(!count($products)) hidden @endif">
                {{ count($products) }}
            </span>
        </a>
        <div class="dropdown-menu animated fadeIn shopping-cart" role="menu">
            @if(count($products))
                <div class="shopping-cart__top text-uppercase">
                    Корзина (<span class="count-cart-items">{{ count($products) }}</span>)
                </div>
                <ul>
                    @foreach($products as $product)
                        <li class='shopping-cart__item'>
                            <div class="shopping-cart__item__image pull-left">
                                <a href="{{ $product->getUrl() }}">
                                    <img src="{{ $product->getImageUrl('mini') }}" alt="{{ $product->image_alt }}"/>
                                </a>
                            </div>
                            <div class="shopping-cart__item__info">
                                <div class="shopping-cart__item__info__title">
                                    <a href="{{ $product->getUrl() }}">
                                        {{ $product->title }}
                                    </a>
                                </div>
                                {{--<div class="shopping-cart__item__info__option">Цвет: Голубой</div>--}}
                                {{--<div class="shopping-cart__item__info__option">Размер: 42-46</div>--}}
                                <div class="shopping-cart__item__info__price">
                                    {{ \App\Helpers\Str::priceFormat($product->price) }}
                                </div>
                                <div class="shopping-cart__item__info__qty">Кол-во: 1</div>
                                <div class="shopping-cart__item__info__delete">
                                    <a href="#" class="icon icon-clear"></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="shopping-cart__bottom">
                    <div class="pull-left">
                        Всего:
                        <span class="shopping-cart__total">22 000 руб.</span>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('cart.index') }}" class="btn btn--wd text-uppercase">
                            Оформить заказ
                        </a>
                    </div>
                </div>
            @else
                <div class="align-center m-t-5">
                    Корзина пуста.
                </div>
            @endif
        </div>
    </div>
</div>

@section('bottom')
    <div class="modal fade bs-example-modal-sm" role="dialog" id="modalAddToCart">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <button type="button" class="close icon-clear" data-dismiss="modal"></button>
                <div class="text-center">
                    <div class="divider divider--xs"></div>
                    <p>Продукт успешно добавлен в корзину!</p>
                    <div class="divider divider--xs"></div>
                    <a href="{{ route('cart.index') }}" class="btn btn--wd">Посмотреть корзину</a>
                    <div class="divider divider--xs"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        jQuery(function($j) {

            "use strict";

            $j(document).on('click', '.add-to-cart', function(e){
                e.preventDefault();
                var $button = $j(this),
                    productId = $j(this).data('productId');

                $button.addClass('btn--wait');
                $j.ajax({
                    url: "{{ route('cart.add') }}",
                    dataType: "json",
                    type: "POST",
                    data: {'id': productId},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success){
                            $button.removeClass('btn--wait');
                            $j('#modalAddToCart').modal("toggle");
                            $j('#cart').html(response.cartHtml);
                        }
                    }
                });
            });
        });

    </script>
@endpush