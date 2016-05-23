<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($products))
    <section class="content">
        <div class="container">
            @if(isset($title))
                <h3 class="text-center text-uppercase">{{ $title }}</h3>
            @endif

            <div class="row product-carousel mobile-special-arrows animated-arrows product-grid four-in-row">
                @foreach($products as $key => $item)
                    @if($item['product'])
                        @include('parts.product', ['item' => $item['product']])
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endif

@push('scripts')
    <script type="text/javascript">

        jQuery(function($j) {

            "use strict";

            $j(document).ready(function(){
                var productId = "{{ $productId }}";

                $j.ajax({
                    url: "{{ route('viewed.add') }}",
                    dataType: "json",
                    type: "POST",
                    data: {'id': productId},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    }
                });
            });
        });

    </script>
@endpush