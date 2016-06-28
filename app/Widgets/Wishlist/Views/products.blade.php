<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if((is_object($products) && $products->total()) || (isset($products['total']) && $products['total']))
    <div class="row">
        <div class="col-md-6">
            <div class="count-container">
                @include('parts.count', ['models' => $products])
            </div>
        </div>
        <div class="col-md-6">
            @if(count($products))
                <a href="#" class="remove-all-from-wishlist pull-right" rel="nofollow">
                    Удалить все
                    <i class="icon icon-clear m-l-5"></i>
                </a>
            @endif
        </div>
    </div>
    <div class="divider divider--xs"></div>

    <ul>
        @foreach($products as $key => $item)
            <li class="shopping-cart__item @if(!(isset($item['product']) && is_object($item['product']))) bg-muted @endif">
                <div class="shopping-cart__item__image pull-left">
                    @if(isset($item['product']) && is_object($item['product']))
                        <a href="{{ $item['product']->getUrl() }}">
                            <img src="{{ $item['product']->getImageUrl('mini') }}" alt="{{ $item['product']->image_alt }}"/>
                        </a>
                    @else
                        <img src="{{ asset('images/product-default-image.jpg') }}" alt="Нет изображения"/>
                    @endif
                </div>
                <div class="shopping-cart__item__info">
                    <div class="shopping-cart__item__info__title">
                        @if(isset($item['product']) && is_object($item['product']))
                            <a href="{{ $item['product']->getUrl() }}">
                                {{ $item['product']->title }}
                            </a>
                        @else
                            <span class="text-danger text-uppercase">
                                Товара уже нет в продаже.
                            </span>
                        @endif
                        <div class="m-t-10">
                            Дата добавления:
                            {{ \App\Helpers\Date::getRelative($item['at']) }}
                        </div>
                    </div>
                    @if(isset($item['product']) && is_object($item['product']))
                        <div class="shopping-cart__item__info__price">
                            {{ \App\Helpers\Str::priceFormat($item['product']->getPrice()) }}
                        </div>
                    @endif
                    <div class="shopping-cart__item__info__delete">
                        <a href="#" class="icon icon-clear remove-from-wishlist" data-product-key="{{ $key }}"></a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="pagination-container text-center">
        {!! $products->links() !!}
    </div>
@else
    <div class="align-center m-t-5">
        Список желаний пуст.
    </div>
@endif

@push('scripts')
    <script type="text/javascript">

        jQuery(function($j) {

            "use strict";

            $j(document).on('click', '.remove-from-wishlist', function(e){
                e.preventDefault();

                var $button = $j(this),
                    productKey = $j(this).data('productKey'),
                    currentPage = "{{ $products->currentPage() }}";

                $j.ajax({
                    url: "{{ route('wishlist.remove') }}",
                    dataType: "json",
                    type: "POST",
                    data: {'key': productKey, 'page': currentPage, 'url': "{{ \Request::url() }}"},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success){
                            $j('#wishlist').html(response.wishlistHtml);
                            $j('.wishlist-products').html(response.wishlistProductsHtml);
                            window.history.pushState({parent: response.pageUrl}, '', response.pageUrl);
                            if(!response.count) {
                                $j('.remove-all-from-wishlist').remove();
                            }
                        }
                    }
                });
            });

            $j(document).on('click', '.remove-all-from-wishlist', function(e){
                e.preventDefault();

                var $button = $j(this);

                $j.ajax({
                    url: "{{ route('wishlist.removeAll') }}",
                    dataType: "json",
                    type: "POST",
                    data: {'url': "{{ \Request::url() }}"},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success){
                            $j('#wishlist').html(response.wishlistHtml);
                            $j('.wishlist-products').html(response.wishlistProductsHtml);
                            window.history.pushState({parent: response.pageUrl}, '', response.pageUrl);
                            $button.remove();
                        }
                    }
                });
            });
        });

    </script>
@endpush