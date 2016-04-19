<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Создание заказа';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-6 col-md-6 col-xs-12 hidden-xs">
            <ul class="breadcrumb m-b-10">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
        <div class="col-sm-6 col-md-6 col-xs-12">
            <div class="button pull-right">
                <button type="button" class="btn btn-success btn-bordred waves-effect waves-light m-b-10 button-save-exit">
                    <i class="fa fa-arrow-left"></i>
                    <span>Сохранить и выйти</span>
                </button>
                <button type="button" class="btn btn-success btn-bordred waves-effect waves-light m-b-10 button-save">
                    <i class="fa fa-check"></i>
                    <span class="hidden-sm">Сохранить</span>
                </button>
                <a href="{{ URL::previous() }}" class="btn btn-primary btn-bordred waves-effect waves-light m-b-10 button-cancel">
                    <i class="fa fa-close"></i>
                    <span class="hidden-md hidden-sm">Отмена</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form method="POST" class="form-horizontal" role="form" action="{{ route('admin.orders.store') }}" id="main-form">
                    @include('admin::orders.form')
                </form>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="button pull-right">
                <button type="button" class="btn btn-success btn-bordred waves-effect waves-light m-b-10 button-save-exit">
                    <i class="fa fa-arrow-left"></i>
                    <span>Сохранить и выйти</span>
                </button>
                <button type="button" class="btn btn-success btn-bordred waves-effect waves-light m-b-10 button-save">
                    <i class="fa fa-check"></i>
                    <span class="hidden-sm">Сохранить</span>
                </button>
                <a href="{{ URL::previous() }}" class="btn btn-primary btn-bordred waves-effect waves-light m-b-10 button-cancel">
                    <i class="fa fa-close"></i>
                    <span class="hidden-md hidden-sm">Отмена</span>
                </a>
            </div>
        </div>
    </div>

@endsection