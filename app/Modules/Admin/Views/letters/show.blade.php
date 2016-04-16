<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Просмотр письма от: ' . $letter->name . " (" . $letter->email . ')';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-6 col-md-6 col-xs-12 hidden-xs">
            <ul class="breadcrumb m-b-10">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li><a href="{{ route('admin.letters.index') }}">Письма</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
        <div class="col-sm-6 col-md-6 col-xs-12">
            <div class="button pull-right">
                <a href="{{ URL::previous() }}" class="btn btn-primary btn-bordred waves-effect waves-light m-b-10 button-cancel">
                    <i class="fa fa-arrow-left"></i>
                    <span class="hidden-md hidden-sm">Назад к списку писем</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="row">
                    <div class="col-lg-5 col-sm-12 col-xs-12 m-b-15">
                        <div class="row">
                            <div class="col-md-2">Имя:</div>
                            <div class="col-md-10"><h4 class="m-t-0">{{ $letter->name }}</h4></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">Email:</div>
                            <div class="col-md-10"><h4 class="m-t-0">{{ $letter->email }}</h4></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">Тема:</div>
                            <div class="col-md-10"><h4 class="m-t-0">{{ $letter->subject }}</h4></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">Пришло:</div>
                            <div class="col-md-10"><h4 class="m-t-0">{{ \App\Helpers\Date::format($letter->created_at) }}</h4></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">Прочтено:</div>
                            <div class="col-md-10"><h4 class="m-t-0">{{ \App\Helpers\Date::format($letter->updated_at) }}</h4></div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-7 col-sm-12 col-xs-12 m-b-15">
                        <div class="row">
                            <div class="col-md-2">Текст сообщения:</div>
                            <div class="col-md-10"><span class="m-t-0">{{ $letter->message }}</span></div>
                        </div>
                    </div><!-- end col -->

                </div><!-- end row -->

            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->

@endsection