<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Пользователи';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-8">
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
        <div class="col-sm-4">
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-bordred w-md waves-effect waves-light pull-right">
                    Создать пользователя
                </a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="count-container">
                @include('parts.count', ['models' => $users])
            </div>
        </div>
        <div class="col-sm-8">
            <div class="sort pull-right m-b-10">
                <form class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control input-sm" placeholder="Поиск...">
                    </div>
                </form>
            </div>
        </div><!-- end col-->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div id="table-container">
                @include('admin::users.table')
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->

@endsection