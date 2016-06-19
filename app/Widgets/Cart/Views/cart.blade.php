<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div id="cart" class="header__cart pull-left">
    <div class="dropdown pull-right">
        <a href="#" class="btn dropdown-toggle btn--links--dropdown header__cart__button header__dropdowns__button" data-toggle="dropdown" title="Корзина" data-toggle="tooltip">
            <span class="icon icon-bag-alt"></span>
            <span class="badge badge--menu count-cart-items @if(!count($cart['products'])) hidden @endif">
                {{ $cart['count'] }}
            </span>
        </a>
        <div class="dropdown-menu animated fadeIn shopping-cart cart-products cart-products-widget" role="menu">
            @include('widget.cart::productsWidget')
        </div>
    </div>
</div>

@section('bottom')
    @parent

    <div class="modal fade bs-example-modal-sm" role="dialog" id="modalAddToCart">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <button type="button" class="close icon-clear" data-dismiss="modal"></button>
                <div class="text-center">
                    <div class="message success">
                        <div class="infobox__icon"><span class="icon icon icon-bag-alt"></span></div>
                        <span class="infobox__text text"></span>

                        <div class="divider divider--xs"></div>
                        <a href="{{ route('cart.index') }}" class="btn btn--wd">Посмотреть корзину</a>
                    </div>
                    <div class="message error">
                        <span class="infobox__text text"></span>
                    </div>
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
                    productId = $button.data('productId');

                $button.addClass('btn--wait');
                $j('#modalAddToCart .success').hide();
                $j('#modalAddToCart .error').hide();

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
                            $j('#modalAddToCart .error').hide();
                            $j('#modalAddToCart .success').show().find('.text').html(response.message);
                            $j('#cart').html(response.cartHtml);
                        } else {
                            $j('#modalAddToCart').modal("toggle");
                            $j('#modalAddToCart .sussess').hide();
                            $j('#modalAddToCart .error').show().find('.text').html(response.message);
                        }
                    }
                });
            });

            $j(document).on('click', '.remove-from-cart', function(e){
                e.preventDefault();
                e.stopPropagation();

                var $button = $j(this),
                    productKey = $button.data('productKey');

                $j.ajax({
                    url: "{{ route('cart.remove') }}",
                    dataType: "json",
                    type: "POST",
                    data: {
                        'key': productKey},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success){
                            $j('.cart-products-widget').html(response.productsWidgetHtml);
                            $j('.cart-products-table').html(response.productsTableHtml);
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

        // bootstrap minus and plus
        jQuery(function($j) {

            "use strict";

            function changeQuantityAjax(productKey, quantity) {
                $j.ajax({
                    url: "{{ route('cart.quantity') }}",
                    dataType: "json",
                    type: "POST",
                    data: {'key': productKey, 'quantity': quantity},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success){
                            $j('.cart-products-widget').html(response.productsWidgetHtml);
                            $j('.cart-products-table').html(response.productsTableHtml);
                            if(response.productsCount) {
                                $j('.count-cart-items').text(response.productsCount);
                            } else {
                                $j('.count-cart-items').hide();
                            }
                        }
                    }
                });
            }

            $j('.header__dropdowns').on('click', '.input-group-qty input', function(e) {
                e.stopPropagation();
            });

            $j(document).on('click', '.btn-number', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var productKey = $j(this).data('productKey'),
                    productId = $j(this).data('productId');

                var type = $j(this).attr('data-type');
                var input = $j(this).closest('.input-group-qty').find('input.input-qty');
                var currentVal = parseInt(input.val());
                if (!isNaN(currentVal)) {
                    if (type == 'minus') {
                        if (currentVal > input.attr('min')) {
                            var value = currentVal - 1;
                            input.val(value).change();
                            changeQuantityAjax(productKey, value);
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $j(this).attr('disabled', true);
                        }
                    } else if (type == 'plus') {
                        if (currentVal < input.attr('max')) {
                            var value = currentVal + 1;
                            input.val(value).change();
                            changeQuantityAjax(productKey, value);
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $j(this).attr('disabled', true);
                        }
                    }
                } else {
                    input.val(0);
                }
            });
            $j(document).on('focusin', '.input-number', function(e) {
                e.stopPropagation();
                $j(this).data('oldValue', $j(this).val());
            });
            $j(document).on('change', '.input-number', function(e) {
                e.stopPropagation();
                var minValue = parseInt($j(this).attr('min'));
                var maxValue = parseInt($j(this).attr('max'));
                var valueCurrent = parseInt($j(this).val());
                var productKey = $j(this).data('productKey'),
                    productId = $j(this).data('productId');
                console.log(valueCurrent, minValue, maxValue);

                var name = $j(this).attr('name');
                if (valueCurrent >= minValue) {
                    $j(this).closest('.input-group-qty').find(".btn-number[data-type='minus']").removeAttr('disabled')
                } else {
                    $j(this).val($j(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $j(this).closest('.input-group-qty').find(".btn-number[data-type='plus']").removeAttr('disabled')
                } else {
                    $j(this).val($j(this).data('oldValue'));
                }
                if (valueCurrent >= minValue && valueCurrent <= maxValue) {
                    changeQuantityAjax(productKey, valueCurrent);
                }
            });
        });

    </script>
@endpush