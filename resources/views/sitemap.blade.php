<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.main')

@section('content')
    <!-- Breadcrumb section -->

    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb--wd pull-left">
                <li><a href="{{ url('/') }}">Главная</a></li>
                <li class="active">{{ $page->getTitle() }}</li>
            </ol>
        </div>
    </div>

    <!-- Content section -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if($page->title)
                        <h2 class="text-uppercase">{{ $page->title }}</h2>
                    @endif

                    {!! $page->content !!}
                </div>

                <div id="sitemap">
                    <div class="col-md-6">
                        <ul>
                            @foreach($sitemapItems as $item)
                                <li>
                                    <a href="{{ $item->getUrl() }}">
                                        @if($item->type == \App\Models\Page::TYPE_CATALOG)
                                            <i class="icon icon-bag-alt"></i>
                                        @endif
                                        <span>{{ $item->getTitle() }}</span>
                                    </a>
                                    {{ \App\Helpers\View::getChildrenPages($item, $item->getUrl()) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <ul>
                            {{--@foreach($sitemapItemsRight as $item)--}}
                                {{--<li>--}}
                                    {{--<a href="{{ $item->getUrl() }}">--}}
                                        {{--@if($item->type == \App\Models\Page::TYPE_CATALOG)--}}
                                            {{--<i class="icon icon-bag-alt"></i>--}}
                                        {{--@endif--}}
                                        {{--<span>{{ $item->getTitle() }}</span>--}}
                                    {{--</a>--}}
                                    {{--{{ \App\Helpers\View::getChildrenPages($item) }}--}}
                                {{--</li>--}}
                            {{--@endforeach--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Content section -->
@endsection