<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = $page->title;
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="background-icon">
                <h3 class="error-code">{{ $page->code }}</h3>
                <i class="fa {{ $page->icon }}"></i>
                <p>{{ $page->content }}</p>
            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->

@endsection