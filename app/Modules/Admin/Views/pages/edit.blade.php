<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = $page->type == \App\Models\Page::TYPE_CATALOG
        ? 'Редактирование каталога товаров "' . $page->getTitle() . '"'
        : 'Редактирование страницы "' . $page->getTitle() . '"';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-6 col-md-6 col-xs-12 hidden-xs">
            <ul class="breadcrumb m-b-10">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
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

            <div class="row">
                <div class="col-md-6">
                    @if($page->user)
                        <p class="pull-left">
                            Автор:
                            <a href="{{ route('admin.users.show', ['id' => $page->user->id]) }}">
                                <img src="{{ $page->user->getAvatarUrl() }}" class="img-circle m-l-5" width="30px" alt="{{ $page->user->login }}">
                                <span class="m-l-5">{{ $page->user->login }}</span>
                            </a>
                        </p>
                    @endif
                </div>
                <div class="col-md-6">
                    @if($page->updated_at)
                        <p class="pull-right">
                            Последнее обновение: {{ \App\Helpers\Date::format($page->updated_at) }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="card-box">
                {!! Form::model($page, ['route' => ['admin.pages.update', $page->id], 'class' => 'form-horizontal', 'id' => 'main-form', 'files' => true]) !!}
                    {!! Form::hidden('_method', 'PUT') !!}

                    @include('admin::pages.form')

                {!! Form::close() !!}
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