<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.main')

@section('content')
<!-- Breadcrumb section -->

<section class="breadcrumbs  hidden-xs">
    <div class="container">
        @include('parts.breadcrumbs')
    </div>
</section>

<!-- Content section -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @if($page->title)
                    <h2 class="text-uppercase">{{ $page->title }}</h2>
                @endif

                {!! $page->content !!}

                @if($page->is_container)
                    <div class="count-container">
                        @include('parts.count', ['models' => $childrenPages])
                    </div>

                    <div class="pages-container">
                        @foreach($childrenPages as $child)
                            <div class="card card--padding m-t-10 m-b-20">
                                <div class="row">
                                    <div class="col-sm-7 col-md-8">
                                        <a href="{{ $child->getUrl() }}">
                                            <h3 class="text-uppercase">{{ $child->getTitle() }}</h3>
                                        </a>
                                    </div>
                                    <div class="col-sm-5 col-md-4">
                                        <span class="pull-right">
                                            <i class="icon icon-clock"></i>
                                            {{ \App\Helpers\Date::format($child->published_at) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($child->image)
                                            <a href="{{ $child->getUrl() }}">
                                                <img src="{{ $child->getImageUrl() }}" alt="{{ $child->image_alt }}">
                                            </a>
                                        @endif
                                        {!! $child->getIntrotext() !!}
                                        <div class="divider divider--sm"></div>
                                        <a style="animation-delay: 0.5s;" href="{{ $child->getUrl() }}" class="btn btn--wd animation animated fadeInUp pull-right" data-animation="fadeInUp" data-animation-delay="0.5s">
                                            <span class="text-uppercase pull-left">Подробнее</span>
                                            <i class="icon icon-arrow-right pull-left m-l-5"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-container text-center">
                        @include('parts.pagination', ['models' => $childrenPages])
                    </div>
                @endif
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12 animation" data-animation="fadeInRight" data-animation-delay="0s">
                        <div class="card card--icon">
                            <div class="card--icon__cell">
                                <a href="#" class="icon card--icon__cell__icon icon-money"></a>
                                <h5 class="card--icon__cell__title text-uppercase">Онлайн оплата</h5>
                            </div>
                            <div class="card--icon__text text-center">
                                <em>
                                    Возможность оплаты картами VISA, MasterCard, Maestro.
                                </em>
                            </div>
                        </div>
                    </div>
                    <div class="divider divider--sm"></div>
                    <div class="col-md-12 animation" data-animation="fadeInRight" data-animation-delay="0.3s">
                        <div class="card card--icon">
                            <div class="card--icon__cell">
                                <a href="#" class="icon card--icon__cell__icon icon-truck"></a>
                                <h5 class="card--icon__cell__title text-uppercase">Быстрая доставка</h5>
                            </div>
                            <div class="card--icon__text text-center">
                                <em>
                                    Доставка курьерскими службами "Новая почта", "Интайм" и пр.
                                </em>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{!! $articlesWidget->show(0) !!}

<!-- End Content section -->
@endsection