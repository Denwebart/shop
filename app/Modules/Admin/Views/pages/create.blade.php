<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Создание страницы';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-8">
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
        <div class="col-sm-4">
            <div class="button pull-right">
                <button type="button" class="btn btn-success w-md waves-effect waves-light">
                    <i class="fa fa-arrow-left"></i>
                    Сохранить и выйти
                </button>
                <button type="button" class="btn btn-success w-md waves-effect waves-light">
                    <i class="fa fa-check"></i>
                    Сохранить
                </button>
                <button type="button" class="btn btn-primary w-md waves-effect waves-light">
                    <i class="fa fa-close"></i>
                    Отмена
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form class="form-horizontal" role="form">
                    @include('admin::pages.form')
                </form>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->

@endsection