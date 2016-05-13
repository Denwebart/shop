<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div id="wishlist" class="header__wishlist pull-left">
    <a href="{{ route('wishlist.index') }}" class="btn dropdown-toggle btn--links--dropdown header__wishlist__button header__dropdowns__button" title="Список желаний" data-toggle="tooltip">
        <span class="icon icon-favorite"></span>
        <span class="badge badge--menu count-wishlist-items @if(!count($products)) hidden @endif">
            {{ count($products) }}
        </span>
    </a>
</div>

@section('bottom')
    @parent

    <div class="modal fade bs-example-modal-sm" role="dialog" id="modalAddToWishlist">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <button type="button" class="close icon-clear" data-dismiss="modal"></button>
                <div class="text-center">
                    <div class="divider divider--xs"></div>
                    <div class="loading">
                        <div class="divider divider--sm"></div>
                        <div class="loader">
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                        </div>
                    </div>
                    <p class="success">Продукт успешно добавлен в Ваш список желаний! </p>
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

            $j(document).on('click', '.add-to-wishlist', function(e){
                e.preventDefault();
                var $button = $j(this),
                    productId = $j(this).data('productId');

                $j('#modalAddToWishlist').modal("toggle");
                $j('#modalAddToWishlist .loading').show();
                $j('#modalAddToWishlist .success').hide();

                $j.ajax({
                    url: "{{ route('wishlist.add') }}",
                    dataType: "json",
                    type: "POST",
                    data: {'id': productId},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success){
                            $j('#modalAddToWishlist .loading').hide();
                            $j('#modalAddToWishlist .success').show();
                            $j('#wishlist').html(response.wishlistHtml);
                        }
                    }
                });
            });

            $j(document).on('click', '.remove-from-wishlist', function(e){
                e.preventDefault();

                var $button = $j(this),
                    productId = $j(this).data('productId');

                $j.ajax({
                    url: "{{ route('wishlist.remove') }}",
                    dataType: "json",
                    type: "POST",
                    data: {'id': productId},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success){
                            $j('#wishlist').html(response.wishlistHtml);
                            $j('.wishlist-products').html(response.wishlistProductsHtml);
                        }
                    }
                });
            });
        });

    </script>
@endpush