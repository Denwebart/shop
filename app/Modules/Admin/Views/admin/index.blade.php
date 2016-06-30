<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Административная панель';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    {{--<div class="row">--}}

        {{--<div class="col-lg-3 col-md-6">--}}
            {{--<div class="card-box">--}}

                {{--<div class="pull-right">--}}
                    {{--<a href="{{ route('admin.orders.index') }}" class="card-drop">--}}
                        {{--<i class="fa fa-angle-double-right"></i>--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<h4 class="header-title m-t-0 m-b-30">--}}
                    {{--<a href="{{ route('admin.orders.index') }}">--}}
                        {{--Заказы--}}
                    {{--</a>--}}
                {{--</h4>--}}

                {{--<div class="widget-box-2">--}}
                    {{--<div class="widget-detail-2">--}}
                        {{--<span class="badge badge-success pull-left m-t-20">32% <i class="zmdi zmdi-trending-up"></i> </span>--}}
                        {{--<h2 class="m-b-0">11</h2>--}}
                        {{--<p class="text-muted">Revenue today</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div><!-- end col -->--}}

        {{--<div class="col-lg-3 col-md-6">--}}
            {{--<div class="card-box">--}}

                {{--<div class="pull-right">--}}
                    {{--<a href="{{ route('admin.letters.index') }}" class="card-drop">--}}
                        {{--<i class="fa fa-angle-double-right"></i>--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<h4 class="header-title m-t-0 m-b-30">--}}
                    {{--<a href="{{ route('admin.letters.index') }}">Письма</a>--}}
                {{--</h4>--}}

                {{--<div class="widget-chart-1">--}}
                    {{--<div class="widget-chart-box-1">--}}
                        {{--<input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "--}}
                               {{--data-bgColor="#F9B9B9" value="58"--}}
                               {{--data-skin="tron" data-angleOffset="180" data-readOnly=true--}}
                               {{--data-thickness=".15"/>--}}
                    {{--</div>--}}

                    {{--<div class="widget-detail-1">--}}
                        {{--<h2 class="p-t-10 m-b-0"> 256 </h2>--}}
                        {{--<p class="text-muted">Revenue today</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div><!-- end col -->--}}

        {{--<div class="col-lg-3 col-md-6">--}}
            {{--<div class="card-box">--}}

                {{--<div class="pull-right">--}}
                    {{--<a href="{{ route('admin.reviews.index') }}" class="card-drop">--}}
                        {{--<i class="fa fa-angle-double-right"></i>--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<h4 class="header-title m-t-0 m-b-30">--}}
                    {{--<a href="{{ route('admin.reviews.index') }}">Отзывы</a>--}}
                {{--</h4>--}}

                {{--<div class="widget-chart-1">--}}
                    {{--<div class="widget-chart-box-1">--}}
                        {{--<input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"--}}
                               {{--data-bgColor="#FFE6BA" value="4.5"--}}
                               {{--data-skin="tron" data-angleOffset="180" data-readOnly=true--}}
                               {{--data-thickness=".15"/>--}}
                    {{--</div>--}}
                    {{--<div class="widget-detail-1">--}}
                        {{--<h2 class="p-t-10 m-b-0">5</h2>--}}
                        {{--<p class="text-muted">Revenue today</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div><!-- end col -->--}}

        {{--<div class="col-lg-3 col-md-6">--}}
            {{--<div class="card-box">--}}

                {{--<div class="pull-right">--}}
                    {{--<a href="{{ route('admin.calls.index') }}" class="card-drop">--}}
                        {{--<i class="fa fa-angle-double-right"></i>--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<h4 class="header-title m-t-0 m-b-30">--}}
                    {{--<a href="{{ route('admin.calls.index') }}">Заказанные звонки</a>--}}
                {{--</h4>--}}

                {{--<div class="widget-box-2">--}}
                    {{--<div class="widget-detail-2">--}}
                        {{--<span class="badge badge-pink pull-left m-t-20">32% <i class="zmdi zmdi-trending-up"></i> </span>--}}
                        {{--<h2 class="m-b-0"> 158 </h2>--}}
                        {{--<p class="text-muted m-b-25">Revenue today</p>--}}
                    {{--</div>--}}
                    {{--<div class="progress progress-bar-pink-alt progress-sm m-b-0">--}}
                        {{--<div class="progress-bar progress-bar-pink" role="progressbar"--}}
                             {{--aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"--}}
                             {{--style="width: 77%;">--}}
                            {{--<span class="sr-only">77% Complete</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div><!-- end col -->--}}

    {{--</div>--}}
    <!-- end row -->

    <div class="row">

        <div class="col-lg-8">
            <div class="card-box">
                <div class="pull-right">
                    <a href="{{ route('admin.orders.index') }}" class="card-drop">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>

                <h4 class="header-title m-t-0 m-b-30">
                    <a href="{{ route('admin.orders.index') }}">Последние заказы</a>
                </h4>

                <div class="table-responsive">
                    @if(count($orders))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Покупатель</th>
                                    <th></th>
                                    <th>Сумма</th>
                                    <th>Дата заказа</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr @if(!$order->status) class="bg-muted" @endif>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer->user_name }}</td>
                                        <td>{{ $order->customer->getPhone() }}</td>
                                        <td>{{ $order->getTotalPrice() }}</td>
                                        <td>{{ \App\Helpers\Date::format($order->created_at) }}</td>
                                        <td>
                                            @if($order->status)
                                                <span class="label  @if($order->status) label-{{ \App\Models\Order::$statusesClass[$order->status] }} @endif">
                                                    {{ \App\Models\Order::$statuses[$order->status] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}"  title="Просмотреть" data-toggle="tooltip">
                                                <i class="fa fa-eye fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="background-icon mini m-t-80 m-b-100">
                            <p>Заказов нет</p>
                            <a href="{{ route('admin.orders.create') }}">
                                <i class="fa fa-shopping-cart"></i>
                                <i class="fa fa-plus lower"></i>
                                <span class="m-t-10">добавить заказ</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-4">
            <div class="card-box">

                <div class="pull-right">
                    <a href="{{ route('admin.calls.index') }}" class="card-drop">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>

                <h4 class="header-title m-t-0 m-b-30">
                    <a href="{{ route('admin.calls.index') }}">
                        Заказанные звонки
                    </a>
                </h4>

                <div class="inbox-widget nicescroll" style="height: 315px;">
                    @forelse($calls as $call)
                        <a href="{{ route('admin.calls.edit', ['id' => $call->id]) }}">
                            <div class="inbox-item @if(is_null($call->status)) bg-muted @endif">
                                <div class="inbox-item-img">
                                    @if($call->user)
                                        <img src="{{ $call->user->getAvatarUrl() }}" class="img-circle" alt="{{ $call->user->login }}" title="Ответил {{ $call->user->login }}" data-toggle="tooltip" data-placement="right">
                                    @else
                                        <div class="empty"></div>
                                    @endif
                                </div>
                                <p class="inbox-item-author">{{ $call->name }}</p>
                                <p class="inbox-item-text">
                                    <span class="phone">{{ $call->getPhone() }}</span>
                                    @if($call->status)
                                        <span class="label @if($call->status == \App\Models\RequestedCall::STATUS_PHONED) label-success @else label-danger @endif pull-right">
                                            {{ \App\Models\RequestedCall::$statuses[$call->status] }}
                                        </span>
                                    @endif
                                </p>
                                <p class="inbox-item-date">{{ \App\Helpers\Date::getRelative($call->created_at) }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="background-icon mini m-t-80">
                            <p>Звонков нет</p>
                            <i class="fa fa-phone"></i>
                        </div>
                    @endforelse
                </div>
            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->

@endsection