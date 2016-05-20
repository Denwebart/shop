<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))
    <!-- Slider section -->
    <section class="content">
        <div class="container">
            @if(isset($title))
                <h3 class="text-center text-uppercase">{{ $title }}</h3>
            @endif
            <div class="row product-carousel mobile-special-arrows animated-arrows product-grid four-in-row">
                @each('parts.product', $items, 'item')
            </div>
        </div>
    </section>
@endif