<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($items))
    <!-- Reviews Section -->
    <section class="content">
        <div class="container">
            <div class="row staggered-animation-container">
                @if(isset($title))
                    <h2 class="text-center text-uppercase">{{ $title }}</h2>
                @endif
                @foreach($items as $item)
                    <div class="testimonials">
                        <div class="col-sm-6 col-md-3 animation" data-animation="fadeInUp" data-animation-delay="0.1s">
                            <div class="testimonials__item">
                                <div class="testimonials__item__image-sell">
                                    <a href="#">
                                        <img src="{{ $item->getUserAvatarUrl() }}" alt="{{ $item->user_name }}"/>
                                    </a>
                                    <div class="testimonials__item__image-sell__author text-uppercase">
                                        {{ $item->user_name }}
                                    </div>
                                </div>
                                <div class="testimonials__item__text">
                                    <em>
                                        {{ $item->text }}
                                    </em>
                                </div>
                            </div>
                        </div>
                        <div class="divider divider--sm visible-xs"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif