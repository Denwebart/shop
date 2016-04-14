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
        <th>Телефон</th>
        <th>Товары</th>
        <th>Сумма</th>
        <th>Дата заказа</th>
        <th>Статус</th>
        <th>Менеджер</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr @if(!$order->status) class="bg-muted" @endif>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer->username }}</td>
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
                    <span class="label @if($order->status) label-{{ \App\Models\Order::$statusesClass[$order->status] }} @endif">
                        {{ \App\Models\Order::$statuses[$order->status] }}
                    </span>
                </td>
                <td>
                    @if($order->user)
                        <a href="{{ route('admin.users.show', ['id' => $order->user->id]) }}">
                            {{ $order->user->login }}
                        </a>
                    @endif</td>
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