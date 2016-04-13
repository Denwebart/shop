<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Просмотр информации о пользователе ' . $user->login;
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-8">
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            @include('admin::users.user')
        </div> <!-- end col -->

        <div class="col-md-8">
            <h3>Статистика:</h3>
            Обработанных заказов: {{ count($user->orders) }} <br>
            Обработанных звонков: {{ count($user->requestedCalls) }} <br>
            Комментариев: {{ count($user->comments) }} <br>
        </div>
    </div>
    <!-- end row -->

@endsection