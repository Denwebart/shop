<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($pages))
    <section class="content content--fill bottom-null">
        <div class="container">
            @if($title)
                <h2 class="text-center">{{ $title }}</h2>
            @endif
            <div class="row">
                @foreach($pages as $key => $page)
                    <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0.5s">
                        <h5 class="title text-uppercase">
                            <a href="{{ $page->getUrl() }}">
                                {{ $page->title }}
                            </a>
                        </h5>
                        <p>
                            {{ $page->getIntrotext() }}
                        </p>
                        <div class="divider divider--xs"></div>
                        <a href="{{ $page->getUrl() }}" class="btn btn--wd pull-right">
                            <span class="text-uppercase pull-left">Читать далее</span>
                            <i class="icon icon-arrow-right pull-left m-l-5"></i>
                        </a>
                    </div>
                    @if($key < count($pages))
                        <div class="divider divider--sm visible-xs"></div>
                    @endif
                @endforeach
            </div>
            <div class="divider divider--sm"></div>
        </div>
    </section>
@endif