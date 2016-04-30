<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Просмотр информации о заказе №"' . $order->id . '"';
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
                <a href="{{ URL::previous() }}" class="btn btn-primary btn-bordred waves-effect waves-light m-b-10 button-cancel">
                    <i class="fa fa-arrow-left"></i>
                    <span class="hidden-md hidden-sm">Назад к списку заказов</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="m-t-5 m-b-15">
                            Заказ № {{ $order->id }}
                        </h3>
                        <span class="m-r-10">Заказ принял:</span>
                        @if($order->user)
                            <a href="{{ route('admin.users.show', ['id' => $order->user->id]) }}">
                                <img src="{{ $order->user->getAvatarUrl() }}" class="img-circle" width="30px" alt="{{ $order->user->login }}">
                                <span class="m-l-5">{{ $order->user->login }}</span>
                            </a>
                        @else
                            -
                        @endif
                    </div>
                    <div class="pull-right">
                        <h5 class="m-t-15">
                            <strong class="m-r-10">Дата заказа:</strong>
                            {{ \App\Helpers\Date::format($order->created_at) }}
                        </h5>
                        <h5 class="form-group m-t-15">
                            <strong class="m-r-10">Статус заказа:</strong>
                            <a href="javascript:void(0)" id="order-status" data-type="select" data-pk="1" data-value="{{ $order->status }}" data-title="Изменение статуса заказа"></a>
                        </h5>
                    </div>
                </div>
                <div class="panel-body p-t-10">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <h4>Заказчик</h4>
                            <div class="row m-b-10">
                                <div class="col-md-4 col-sm-3">
                                    <p><strong>Имя:</strong></p>
                                </div>
                                <div class="col-md-8 col-sm-9">
                                    @if($order->customer)
                                        <p>{{ $order->customer->username }}</p>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-3">
                                    <p><strong>Телефон:</strong></p>
                                </div>
                                <div class="col-md-8 col-sm-9">
                                    @if($order->customer)
                                        <p>{{ \App\Helpers\Str::phoneFormat($order->customer->phone) }}</p>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4>Оплата</h4>
                            <div class="row m-b-10">
                                <div class="col-md-5 col-sm-3">
                                    <p><strong>Способ оплаты:</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-9">
                                    <p>{{ \App\Models\Order::$paymentTypes[$order->payment_type] }}</p>
                                </div>
                            </div>
                            <div class="row m-b-10">
                                <div class="col-md-5 col-sm-3">
                                    <p><strong>Статус оплаты:</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-9">
                                    <p>
                                        @if(\App\Models\Order::PAYMENT_TYPE_CASH)
                                            <a href="javascript:void(0)" id="payment-status" data-type="select" data-pk="1" data-value="{{ $order->payment_status }}" data-title="Изменение статуса оплаты"></a>
                                        @else
                                            <span class="label label-{{ \App\Models\Order::$paymentStatusesClass[$order->payment_status] }}">
                                                {{ \App\Models\Order::$paymentStatuses[$order->payment_status] }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-sm-3">
                                    <p><strong>Дата оплаты:</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-9">
                                    <p>{{ \App\Helpers\Date::format($order->paid_at) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4>Доставка</h4>
                            <div class="row m-b-10">
                                <div class="col-md-5 col-sm-3">
                                    <p><strong>Способ доставки:</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-9">
                                    @if($order->deliveryType)
                                        <p>{{ $order->deliveryType->title }}</p>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-sm-3">
                                    <p><strong>Адрес доставки:</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-9">
                                    <p>{{ $order->address }}</p>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="m-t-20">Товары</h4>
                            <div class="table-responsive">
                                <table class="table m-t-10">
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Товар</th>
                                            <th>Количество</th>
                                            <th>Цена</th>
                                            <th class="text-right">Всего</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->groupedOrderProducts as $key => $orderProducts)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <img src="{{ $orderProducts->product->getImageUrl() }}" alt="{{ $orderProducts->product->image_alt }}" width="50">
                                                    {{ $orderProducts->product->title }}
                                                    ({{ $orderProducts->product->vendor_code }})
                                                </td>
                                                <td>{{ $orderProducts->quantity }}</td>
                                                <td>{{ \App\Helpers\Str::priceFormat($orderProducts->price) }}</td>
                                                <td class="text-right">{{ \App\Helpers\Str::priceFormat($orderProducts->total_price) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="clearfix m-t-40">
                                <h4>Комментарий к заказу</h4>
                                <small>
                                    {{ $order->comment }}
                                </small>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-2 text-right">
                            <div class="row m-b-10">
                                <div class="col-md-7 col-sm-7">
                                    <p><strong>Всего:</strong></p>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <p>{{ \App\Helpers\Str::priceFormat($order->total_price) }}</p>
                                </div>
                            </div>
                            <div class="row m-b-10">
                                <div class="col-md-7 col-sm-7">
                                    <p><strong>Стоимость доставки:</strong></p>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <p>{{ \App\Helpers\Str::priceFormat(0) }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-sm-7">
                                    <p><strong>Скидка:</strong></p>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <p>
                                        -
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-7 col-sm-7">
                                    <h3 class="font-16">Общая сумма заказа:</h3>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <h3>{{ \App\Helpers\Str::priceFormat($order->total_price) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="hidden-print">
                        <div class="pull-right">
                            <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- end row -->
@endsection

@push('styles')
    <!-- XEditable Plugin -->
    <link type="text/css" href="{{ asset('backend/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- XEditable Plugin -->
    <script type="text/javascript" src="{{ asset('backend/plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>

    <script type="text/javascript">
        //modify buttons style
        $.fn.editableform.buttons =
            '<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="zmdi zmdi-check"></i></button>' +
            '<button type="button" class="btn editable-cancel btn-sm waves-effect"><i class="zmdi zmdi-close"></i></button>';

        $.fn.editableform.defaults.params = function (params) {
            params._token = $("meta[name='csrf-token']").attr('content');
            return params;
        };

        // Изменение статуса заказа
        function getOrderStatues() {
            return $.ajax({
                url: "{{ route('admin.orders.getJsonOrderStatues') }}",
                dataType: "json",
                type: "POST",
                async: true,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                }
            });
        }
        getOrderStatues().done(function(result) {
            $('#order-status').editable({
                type: 'select',
//                prepend: false,
                defaultValue: '{{ $order->status }}',
                ajaxOptions: {
                    dataType: 'json',
                    sourceCache: 'false'
                },
                source: result,
                url: "{{ route('admin.orders.setOrderStatus', ['id' => $order->id]) }}",
                display: function(value, result) {
                    var html = [],
                        checked = $.fn.editableutils.itemsByValue(value, result);

                    var checkedText, checkedClass;
                    $.each(checked, function(i, v) {
                        checkedText = v.text;
                        checkedClass = v.class
                    });

                    if(checked.length) {
                        $.each(checked, function(i, v) { html.push($.fn.editableutils.escape(v.text)); });
                        $(this).html(html.join(', '));
                    } else {
                        $(this).empty();
                    }

                    $(this).html('<span class="label label-' + checkedClass + '">' + checkedText + '</span>');
                },
                success: function(response, newValue) {
                    if(response.success) {
                        Command: toastr["success"](response.message);
                        return true;
                    }
                    return false;
                }
            });
        }).fail(function() {

        });

        // Изменение статуса оплаты
        function getPaymentStatues() {
            return $.ajax({
                url: "{{ route('admin.orders.getJsonPaymentStatues') }}",
                dataType: "json",
                type: "POST",
                async: true,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                }
            });
        }
        getPaymentStatues().done(function(result) {
            $('#payment-status').editable({
                type: 'select',
                prepend: false,
                defaultValue: '{{ $order->payment_status }}',
                ajaxOptions: {
                    dataType: 'json',
                    sourceCache: 'false'
                },
                source: result,
                url: "{{ route('admin.orders.setPaymentStatus', ['id' => $order->id]) }}",
                display: function(value, result) {
                    var html = [],
                            checked = $.fn.editableutils.itemsByValue(value, result);

                    var checkedText, checkedClass;
                    $.each(checked, function(i, v) {
                        checkedText = v.text;
                        checkedClass = v.class
                    });

                    if(checked.length) {
                        $.each(checked, function(i, v) { html.push($.fn.editableutils.escape(v.text)); });
                        $(this).html(html.join(', '));
                    } else {
                        $(this).empty();
                    }

                    $(this).html('<span class="label label-' + checkedClass + '">' + checkedText + '</span>');
                },
                success: function(response, newValue) {
                    if(response.success) {
                        Command: toastr["success"](response.message);
                        return true;
                    }
                    return false;
                }
            });
        }).fail(function() {

        });

    </script>
@endpush