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

    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card-box">

                <div class="pull-right">
                    <a href="orders.html" class="card-drop">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>

                <h4 class="header-title m-t-0 m-b-30">
                    <a href="orders.html">
                        Заказы
                    </a>
                </h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">
                        <span class="badge badge-success pull-left m-t-20">32% <i class="zmdi zmdi-trending-up"></i> </span>
                        <h2 class="m-b-0">11</h2>
                        <p class="text-muted">Revenue today</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">

                <div class="pull-right">
                    <a href="#" class="card-drop">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>

                <h4 class="header-title m-t-0 m-b-30">
                    <a href="#">Письма</a>
                </h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1">
                        <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "
                               data-bgColor="#F9B9B9" value="58"
                               data-skin="tron" data-angleOffset="180" data-readOnly=true
                               data-thickness=".15"/>
                    </div>

                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> 256 </h2>
                        <p class="text-muted">Revenue today</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">

                <div class="pull-right">
                    <a href="#" class="card-drop">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>

                <h4 class="header-title m-t-0 m-b-30">
                    <a href="#">Отзывы</a>
                </h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1">
                        <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                               data-bgColor="#FFE6BA" value="80"
                               data-skin="tron" data-angleOffset="180" data-readOnly=true
                               data-thickness=".15"/>
                    </div>
                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> 4569 </h2>
                        <p class="text-muted">Revenue today</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">

                <div class="pull-right">
                    <a href="#" class="card-drop">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>

                <h4 class="header-title m-t-0 m-b-30">
                    <a href="#">Заказанные звонки</a>
                </h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">
                        <span class="badge badge-pink pull-left m-t-20">32% <i class="zmdi zmdi-trending-up"></i> </span>
                        <h2 class="m-b-0"> 158 </h2>
                        <p class="text-muted m-b-25">Revenue today</p>
                    </div>
                    <div class="progress progress-bar-pink-alt progress-sm m-b-0">
                        <div class="progress-bar progress-bar-pink" role="progressbar"
                             aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                             style="width: 77%;">
                            <span class="sr-only">77% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->

    <div class="row">

        <div class="col-lg-8">
            <div class="card-box">
                <div class="pull-right">
                    <a href="orders.html" class="card-drop">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>

                <h4 class="header-title m-t-0 m-b-30">
                    <a href="orders.html">Последние заказы</a>
                </h4>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Покупатель</th>
                            <th></th>
                            <th>Сумма</th>
                            <th>Дата заказа</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-muted">
                            <td>1</td>
                            <td>Иван Петрович</td>
                            <td>+38 050 777 77 77</td>
                            <td>5 000 руб.</td>
                            <td>26.04.2016</td>
                            <td></td>
                            <td>
                                <a href="#">
                                    <i class="fa fa-eye fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                        <tr class="bg-muted">
                            <td>2</td>
                            <td>Ирина</td>
                            <td>+38 063 633 63 63</td>
                            <td>10 000 руб.</td>
                            <td>26.04.2016</td>
                            <td></td>
                            <td>
                                <a href="#">
                                    <i class="fa fa-eye fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Анна</td>
                            <td>+38 050 050 50 50</td>
                            <td>158 000 руб.</td>
                            <td>10.05.2016</td>
                            <td><span class="label label-info">В процессе</span></td>
                            <td>
                                <a href="#">
                                    <i class="fa fa-eye fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Валентина Петровна Ивановавава</td>
                            <td>+38 050 777 77 77</td>
                            <td>10 000 руб.</td>
                            <td>31.05.2016</td>
                            <td><span class="label label-info">В процессе</span>
                            </td>
                            <td>
                                <a href="#">
                                    <i class="fa fa-eye fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Татьяна</td>
                            <td>+38 050 777 77 77</td>
                            <td>22 000 руб.</td>
                            <td>31.05.2016</td>
                            <td><span class="label label-danger">Отменен</span></td>
                            <td>
                                <a href="#">
                                    <i class="fa fa-eye fa-lg"></i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>Иван Петрович</td>
                            <td>+38 050 777 77 77</td>
                            <td>13 000 руб.</td>
                            <td>31.05.2016</td>
                            <td><span class="label label-success">Завершен</span></td>
                            <td>
                                <a href="#">
                                    <i class="fa fa-eye fa-lg"></i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>7</td>
                            <td>Иван Петрович</td>
                            <td>+38 050 777 77 77</td>
                            <td>16 000 руб.</td>
                            <td>31.05.2016</td>
                            <td><span class="label label-success">Завершен</span></td>
                            <td>
                                <a href="#">
                                    <i class="fa fa-eye fa-lg"></i>
                                </a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-4">
            <div class="card-box">

                <div class="pull-right">
                    <a href="#" class="card-drop">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>

                <h4 class="header-title m-t-0 m-b-30">
                    <a href="#">
                        Заказанные звонки
                    </a>
                </h4>

                <div class="inbox-widget nicescroll" style="height: 315px;">
                    @forelse($calls as $call)
                        <a href="#">
                            <div class="inbox-item @if(is_null($call->status)) bg-muted @endif">
                                <div class="inbox-item-img">
                                    <img src="{{ asset('backend/images/users/avatar-1.jpg') }}" class="img-circle" alt="">
                                </div>
                                <p class="inbox-item-author">{{ $call->name }}</p>
                                <p class="inbox-item-text">
                                    <span class="phone">{{ $call->phone }}</span>
                                    @if(!is_null($call->status))
                                        <span class="label @if($call->status == \App\Models\RequestedCall::STATUS_PHONED) label-success @else label-danger @endif pull-right">
                                            {{ \App\Models\RequestedCall::$statuses[$call->status] }}
                                        </span>
                                    @endif
                                </p>
                                <p class="inbox-item-date">{{ \App\Helpers\Date::getRelative($call->created_at) }}</p>
                            </div>
                        </a>
                    @empty
                        Звонков нет
                    @endforelse
                </div>
            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->

@endsection