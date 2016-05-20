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
            <ol class="breadcrumb breadcrumb--wd pull-left">
                <li><a href="{{ url('/') }}">Главная</a></li>
                <li class="active">{{ $page->getTitle() }}</li>
            </ol>
        </div>
    </section>

    <!-- Content section -->
    <section class="content">
        <div class="container">
            @if($page->title)
                <h2 class="text-uppercase">{{ $page->title }}</h2>
            @endif

            {!! $page->content !!}

            <div id="sitemap">
                <ul>
                    @foreach($sitemapItems as $item)
                        <li>
                            <a href="{{ $item->getUrl() }}">{{ $item->getTitle() }}</a>
                            {{ \App\Helpers\View::getChildrenPages($item) }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!-- End Content section -->
@endsection