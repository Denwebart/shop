<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

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
                <td>{{ $order->customer->username }}</td>
                <td>{{ $order->customer->phone }}</td>
                <td>{{ $order->total_price }} руб.</td>
                <td>{{ date('j.m.Y в H:i', strtotime($order->created_at)) }}</td>
                <td>
                    <span class="label {{ \App\Models\Order::$statusesClass[$order->status] }}">
                        {{ \App\Models\Order::$statuses[$order->status] }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}" title="Просмотреть" data-toggle="tooltip" class="m-r-15">
                        <i class="fa fa-eye fa-lg"></i>
                    </a>
                    <a href="{{ route('admin.orders.edit', ['id' => $order->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>
                    <a href="#" title="Удалить" data-toggle="tooltip">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>