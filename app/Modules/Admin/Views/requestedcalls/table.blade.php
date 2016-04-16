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
        <th>Имя</th>
        <th>Телефон</th>
        <th>Статус</th>
        <th>Комментарий</th>
        <th>Заказан</th>
        <th>Обработан</th>
        <th>Менеджер</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($calls as $call)
            <tr @if(is_null($call->status)) class="bg-muted" @endif>
                <td>{{ $call->id }}</td>
                <td>{{ $call->name }}</td>
                <td>{{ $call->getPhone() }}</td>
                <td>
                    @if($call->status)
                        <span class="label @if($call->status == \App\Models\RequestedCall::STATUS_PHONED) label-success @else label-danger @endif pull-right">
                            {{ \App\Models\RequestedCall::$statuses[$call->status] }}
                        </span>
                    @endif
                </td>
                <td>{{ $call->comment }}</td>
                <td>{{ \App\Helpers\Date::getRelative($call->created_at) }}</td>
                <td>{{ \App\Helpers\Date::getRelative($call->answered_at) }}</td>
                <td >
                    @if($call->user)
                        <a href="{{ route('admin.users.show', ['id' => $call->user->id]) }}">
                            <img src="{{ $call->user->getAvatarUrl() }}" class="img-circle" width="40px" alt="{{ $call->user->login }}" title="Ответил {{ $call->user->login }}" data-toggle="tooltip" data-placement="right">
                            <span class="m-l-5">{{ $call->user->login }}</span>
                        </a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.calls.edit', ['id' => $call->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>