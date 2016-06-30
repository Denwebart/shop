<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($orders))
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Покупатель</th>
            <th>Телефон</th>
            <th>Товары</th>
            <th>Сумма</th>
            <th>Дата заказа</th>
            <th>Оплата</th>
            <th>Статус</th>
            <th>Менеджер</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr @if(!$order->status) class="bg-muted" @endif>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->user_name }}</td>
                    <td>{{ $order->customer->getPhone() }}</td>
                    <td>
                        <ul class="products-list">
                            @foreach($order->groupedProducts as $product)
                                <li>
                                    <img src="{{ $product->getImageUrl() }}" alt="{{ $product->image_alt }}" width="50">
                                    {{ $product->title }}
                                    ({{ $product->vendor_code }})
                                    x {{ $product->quantity }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->getTotalPrice() }}</td>
                    <td>{{ \App\Helpers\Date::format($order->created_at) }}</td>
                    <td>
                        <span class="label label-{{ \App\Models\Order::$paymentStatusesClass[$order->payment_status] }}">
                            {{ \App\Models\Order::$paymentStatuses[$order->payment_status] }}
                        </span>
                    </td>
                    <td>
                        @if($order->status != \App\Models\Order::STATUS_NONE)
                            <span class="label @if($order->status) label-{{ \App\Models\Order::$statusesClass[$order->status] }} @endif">
                                {{ \App\Models\Order::$statuses[$order->status] }}
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($order->user)
                            <a href="{{ route('admin.users.show', ['id' => $order->user->id]) }}">
                                <img src="{{ $order->user->getAvatarUrl() }}" class="img-circle" width="26" alt="{{ $order->user->login }}" title="Принял заказ {{ $order->user->login }}" data-toggle="tooltip" data-placement="right">
                                <span class="m-l-5">{{ $order->user->login }}</span>
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}" title="Просмотреть" data-toggle="tooltip" class="m-r-15">
                            <i class="fa fa-eye fa-lg"></i>
                        </a>
                        {{--<a href="{{ route('admin.orders.edit', ['id' => $order->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">--}}
                            {{--<i class="fa fa-pencil fa-lg"></i>--}}
                        {{--</a>--}}
                        @if(Auth::user()->isAdmin())
                            <a href="javascript:void(0)" class="button-delete" title="Удалить" data-toggle="tooltip" data-item-id="{{ $order->id }}" data-item-title="">
                                <i class="fa fa-trash fa-lg"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="background-icon">
        <p>Заказов нет</p>
        <a href="{{ route('admin.orders.create') }}">
            <i class="fa fa-shopping-cart"></i>
            <i class="fa fa-plus lower"></i>
            <span>добавить заказ</span>
        </a>
    </div>
@endif

@push('styles')
    <link href="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
    <script type="text/javascript">
        !function ($) {
            "use strict";

            $('#table-container').on('click', '.button-delete', function (e) {
                var itemId = $(this).data('itemId');
                var itemTitle = $(this).data('itemTitle');
                sweetAlert(
                    {
                        title: "Удалить заказ?",
                        text: 'Вы точно хотите удалить заказ №'+ itemId +'?',
                        type: "error",
                        showCancelButton: true,
                        cancelButtonText: 'Отмена',
                        confirmButtonClass: 'btn-danger waves-effect waves-light',
                        confirmButtonText: 'Удалить'
                    },
                    function(){
                        $.ajax({
                            url: "/admin/orders/" + itemId,
                            dataType: "text json",
                            type: "DELETE",
                            data: {},
                            beforeSend: function (request) {
                                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                            },
                            success: function (response) {
                                if (response.success) {
                                    Command: toastr["success"](response.message);

                                    $('.count-container').html(response.itemsCount);
                                    $('.pagination-container').html(response.itemsPagination);
                                    $('#table-container').html(response.itemsTable);
                                    if(!response.itemsCount) {
                                        $('.white-bg').removeClass('card-box');
                                    }
                                } else {
                                    Command: toastr["warning"](response.message);
                                }
                            }
                        });
                    });
            })

        }(window.jQuery);
    </script>
@endpush