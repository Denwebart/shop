<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div id="cart" class="header__cart pull-left">
    @include('widget.cart::cartButton')
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

            $j(document).on('click', '.add-to-cart__color', function(e){
                e.preventDefault();
                var $button = $j(this),
                    color = $button.data('value');
                $j('.add-to-cart__color').removeClass('active');
                $button.addClass('active');
                $j('input[name="add-to-cart__color__input"]').val(color);
            });

            $j(document).on('click', '.add-to-cart__size', function(e){
                e.preventDefault();
                var $button = $j(this),
                    size = $button.data('value');
                $j('.add-to-cart__size').removeClass('active');
                $button.addClass('active');
                $j('input[name="add-to-cart__size__input"]').val(size);
            });

            $j(document).on('click', '.add-to-cart', function(e){
                e.preventDefault();
                var $button = $j(this),
                    productId = $button.data('productId'),
                    quantity = $j('input.add-to-cart__quantity').val(),
                    color = $j('input[name="add-to-cart__color__input"]').val(),
                    size = $j('input[name="add-to-cart__size__input"]').val();

                var data = {'id': productId};
                if(quantity) {
                    data['quantity'] = quantity;
                }
                if(color) {
                    data['options[color]'] = color;
                }
                if(size) {
                    data['options[size]'] = size;
                }

                $button.addClass('btn--wait');
                $j('#modalAddToCart .success').hide();
                $j('#modalAddToCart .error').hide();

                $j.ajax({
                    url: "{{ route('cart.add') }}",
                    dataType: "json",
                    type: "POST",
                    data: data,
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
                            $j('.add-to-cart__quantity').val(1);
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
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $j(this).attr('disabled', true);
                        }
                    } else if (type == 'plus') {
                        if (currentVal < input.attr('max')) {
                            var value = currentVal + 1;
                            input.val(value).change();
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
            });

            $j(document).on('change', '.change-quantity', function(e) {
                e.stopPropagation();
                var minValue = parseInt($j(this).attr('min'));
                var maxValue = parseInt($j(this).attr('max'));
                var valueCurrent = parseInt($j(this).val());
                var productKey = $j(this).data('productKey'),
                        productId = $j(this).data('productId');

                var name = $j(this).attr('name');

                if (valueCurrent >= minValue && valueCurrent <= maxValue) {
                    changeQuantityAjax(productKey, valueCurrent);
                }
            });
        });

    </script>
@endpush