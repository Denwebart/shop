<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<!-- Slider section -->
<section class="content p-t-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="category-slider single-slider">
                    <ul class="animated-arrows">
                        @foreach($items as $item)
                            <li class="hover-squared">
                                <img src="{{ $item->getImageUrl() }}" alt="{{ $item->image_alt }}"/>
                                <div class="single-slider__text {{ \App\Models\Slider::$textAlignClasses[$item->text_align] }}">
                                    @if($item->title) <h2>{{ $item->title }}</h2> @endif
                                    @if($item->text_1) <h3>{{ $item->text_1 }}</h3> @endif
                                    @if($item->text_2) <h4>{{ $item->text_2 }}</h4> @endif
                                    @if($item->button_link)
                                        <a href="{{ $item->button_link }}" class="btn btn--wd btn--lg text-uppercase">
                                            {{ $item->button_text or 'Подробнее' }}
                                        </a>
                                    @endif
                                </div>
                                <div class="product-category__hover caption"></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="divider divider--sm visible-xs visible-sm"></div>
            </div>
        </div>
    </div>
</section>
<!-- End Slider section -->
