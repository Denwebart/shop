<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div id="wishlist" class="header__wishlist pull-left">
    @include('widget.wishlist::wishlistButton')
</div>

@section('bottom')
    @parent

    <div class="modal fade bs-example-modal-sm" role="dialog" id="modalAddToWishlist">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <button type="button" class="close icon-clear" data-dismiss="modal"></button>
                <div class="text-center">
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
                    <div class="message success">
                        <div class="infobox__icon"><span class="icon icon-favorite"></span></div>
                        <span class="infobox__text text"></span>
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

            $j(document).on('click', '.add-to-wishlist', function(e){
                e.preventDefault();
                var $button = $j(this),
                    productId = $j(this).data('productId');

                $j('#modalAddToWishlist').modal("toggle");
                $j('#modalAddToWishlist .loading').show();
                $j('#modalAddToWishlist .success').hide();
                $j('#modalAddToWishlist .error').hide();

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
                            $button.addClass('active');
                            $j('#modalAddToWishlist .loading').hide();
                            $j('#modalAddToWishlist .error').hide();
                            $j('#modalAddToWishlist .success').show().find('.text').html(response.message);
                            $j('#wishlist').html(response.wishlistHtml);
                        } else {
                            $j('#modalAddToWishlist .loading').hide();
                            $j('#modalAddToWishlist .sussess').hide();
                            $j('#modalAddToWishlist .error').show().find('.text').html(response.message);
                        }
                    }
                });
            });
        });

    </script>
@endpush