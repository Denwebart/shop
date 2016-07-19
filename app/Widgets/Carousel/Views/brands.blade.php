<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))
    <!-- Brands section -->
    <section class="content content--fill top-null">
        <div class="container">
            @if(isset($title))
                <h3 class="text-center text-uppercase">{{ $title }}</h3>
            @endif
            <div class="brands brands-carousel animated-arrows mobile-special-arrows">
                @foreach($items as $item)
                    <div class="brands__item">
                        <img src="{{ $item->getImageUrl() }}" data-lazy="{{ $item->getImageUrl() }}" alt="{{ $item->title }}" title="{{ $item->title }}" class="tooltip-link" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif