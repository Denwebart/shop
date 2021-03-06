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