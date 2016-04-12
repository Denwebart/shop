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
        <th>Дата звонка</th>
        <th>Принят</th>
        <th>Менеджер</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($requestedcalls as $requestedcall)
            <tr @if(is_null($requestedcall->status)) class="bg-muted" @endif>
                <td>{{ $requestedcall->id }}</td>
                <td>{{ $requestedcall->name }}</td>
                <td>{{ $requestedcall->getPhone() }}</td>
                <td>
                    @if(!is_null($requestedcall->status))
                        <span class="label @if($requestedcall->status == \App\Models\RequestedCall::STATUS_PHONED) label-success @else label-danger @endif pull-right">
                            {{ \App\Models\RequestedCall::$statuses[$requestedcall->status] }}
                        </span>
                    @endif
                </td>
                <td>{{ $requestedcall->comment }}</td>
                <td>{{ \App\Helpers\Date::getRelative($requestedcall->created_at) }}</td>
                <td>{{ \App\Helpers\Date::getRelative($requestedcall->updated_at) }}</td>
                <td>{{ $requestedcall->user_id }}</td>
                <td>
                    <a href="{{ route('admin.calls.edit', ['id' => $requestedcall->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>