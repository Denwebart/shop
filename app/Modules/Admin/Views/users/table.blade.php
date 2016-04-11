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
        <th></th>
        <th>Роль</th>
        <th>Логин</th>
        <th>Email</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Дата регистрации</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr @if(!$user->is_active) class="not-published" @endif>
                <td>{{ $user->id }}</td>
                <td>
                    <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->login }}">
                </td>
                <td>
                    <span class="label @if($user->isAdmin()) label-success @else label-info @endif">
                        {{ \App\Models\User::$roles[$user->role] }}
                    </span>
                </td>
                <td>{{ $user->login }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ date('j.m.Y в H:i', strtotime($user->created_at)) }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
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