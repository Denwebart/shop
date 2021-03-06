@extends('layouts.main')

@section('content')

{!! $slider->show() !!}

@if(count($leadersOfSells))
    <!-- 12 items -->
    <section class="content">
        <div class="container">
            <h3 class="text-center text-uppercase">Лидеры продаж</h3>

            <div class="products-grid products-listing products-col four-in-row">
                @each('parts.product', $leadersOfSells, 'item')
            </div>
        </div>
    </section>
@endif

<!-- Content section -->
<section class="content p-b-0">
    <div class="container">
        @if($page->title)
            <h2 class="text-uppercase">{{ $page->title }}</h2>
        @endif

        {!! $page->content !!}
    </div>
</section>

<!-- Carousel section -->
{!! $carousel->sale() !!}

<!-- Brands Section -->
{!! $carousel->workWithUs() !!}

<!-- Reviews Section -->
{!! $review->show() !!}

<!-- End Content section -->
@endsection