<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div id="cart" class="header__cart pull-left">
    <div class="dropdown pull-right">
        <a href="#" class="btn dropdown-toggle btn--links--dropdown header__cart__button header__dropdowns__button" data-toggle="dropdown">
            <span class="icon icon-bag-alt"></span>
            <span class="badge badge--menu count-cart-items @if(!count($cart['products'])) hidden @endif">
                {{ count($cart['products']) }}
            </span>
        </a>
        <div class="dropdown-menu animated fadeIn shopping-cart cart-products" role="menu">
            @include('widget.cart::cartProducts')
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

            $j(document).on('click', '.remove-from-cart', function(e){
                e.preventDefault();
                e.stopPropagation();

                var $button = $j(this),
                    productId = $j(this).data('productId'),
                    productKey = $j(this).data('productKey');

                $j.ajax({
                    url: "{{ route('cart.remove') }}",
                    dataType: "json",
                    type: "POST",
                    data: {'id': productId, 'key': productKey},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success){
                            $j('.cart-products').html(response.cartProductsHtml);
                            if(response.productsCount) {
                                $j('.count-cart-items').text(response.productsCount);
                            } else {
                                $j('.count-cart-items').hide();
                            }
                        }
                    }
                });
            });
        });

    </script>
@endpush