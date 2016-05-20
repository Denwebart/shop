@extends('layouts.main')

@section('content')

{!! $slider->show() !!}

@if(count($bestSellers))
    <!-- 12 items -->
    <section class="content">
        <div class="container">
            <h3 class="text-center text-uppercase">Лидеры продаж</h3>

            <div class="products-grid products-listing products-col four-in-row">
                @each('parts.product', $bestSellers, 'item')
            </div>
        </div>
    </section>
@endif

<!-- Content section -->
<section class="content">
    <div class="container">
        @if($page->title)
            <h1 class="text-uppercase">{{ $page->title }}</h1>
        @endif

        {!! $page->content !!}
    </div>
</section>

<!-- Carousel section -->
{!! $carousel->sale() !!}

<!-- Brands Section -->
<section class="content content--fill top-null">
    <div class="container">
        <h3 class="text-center text-uppercase">С нами сотрудничают</h3>
        <div class="brands brands-carousel animated-arrows mobile-special-arrows">
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-01.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-02.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-03.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-04.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-05.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-06.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-07.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-01.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-02.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-03.png" alt=""/></a></div>
        </div>
    </div>
</section>
<!-- End Brands Section -->

{!! $review->show() !!}

<!-- End Content section -->
@endsection
