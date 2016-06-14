<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Создание товара';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-6 col-md-6 col-xs-12 hidden-xs">
            <ul class="breadcrumb m-b-10">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li><a href="{{ route('admin.products.index') }}">Товары</a></li>
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
                <a href="{{ $backUrl }}" class="btn btn-primary btn-bordred waves-effect waves-light m-b-10 button-cancel">
                    <i class="fa fa-close"></i>
                    <span class="hidden-md hidden-sm">Отмена</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="active">
                    <a href="#product-info" role="tab" data-toggle="tab">Основная информация</a>
                </li>
                <li role="presentation">
                    <a href="#product-property" role="tab" data-toggle="tab">Характеристики товара</a>
                </li>
            </ul>
            <div class="tab-content card-box">
                <div role="tabpanel" class="tab-pane fade in active" id="product-info">
                    {!! Form::model($product, ['route' => ['admin.products.store'], 'class' => 'form-horizontal', 'id' => 'main-form', 'files' => true]) !!}

                        @include('admin::products.form')

                    {!! Form::close() !!}
                </div>
                <div role="tabpanel" class="tab-pane fade" id="product-property">
                    @include('admin::productProperties.index', ['productProperties' => []])
                </div>
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
                <a href="{{ $backUrl }}" class="btn btn-primary btn-bordred waves-effect waves-light m-b-10 button-cancel">
                    <i class="fa fa-close"></i>
                    <span class="hidden-md hidden-sm">Отмена</span>
                </a>
            </div>
        </div>
    </div>

@endsection