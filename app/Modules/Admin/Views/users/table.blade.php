<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="row">
    @foreach($users as $user)
        <div class="col-md-4">
            <div class="text-center card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Редактировать</a></li>
                        <li><a href="#">Удалить</a></li>
                        <li><a href="#">Заблокировать</a></li>
                    </ul>
                </div>
                <div>
                    <img src="{{ $user->getAvatarUrl() }}" class="img-circle thumb-xl img-thumbnail m-b-10" alt="{{ $user->login }}">

                    <p class="text-muted font-13 m-b-30">
                        Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                    </p>

                    <div class="text-left">
                        <p class="text-muted font-13"><strong>Логин :</strong> <span class="m-l-15">{{ $user->login }}</span></p>

                        <p class="text-muted font-13"><strong>Имя и фамилия :</strong><span class="m-l-15">{{ $user->getFullName() }}</span></p>

                        <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ $user->email }}</span></p>

                        <p class="text-muted font-13"><strong>Права :</strong> <span class="m-l-15">{{ $user->role }}</span></p>

                        <p class="text-muted font-13"><strong>Дата регистрации :</strong> <span class="m-l-15">{{ $user->created_at }}</span></p>
                    </div>

                    <button type="button" class="btn btn-custom btn-rounded waves-effect waves-light">Отправить сообщение</button>
                </div>

            </div>

        </div> <!-- end col -->
    @endforeach
</div>








{{--<table class="table">--}}
    {{--<thead>--}}
    {{--<tr>--}}
        {{--<th>ID</th>--}}
        {{--<th></th>--}}
        {{--<th>Роль</th>--}}
        {{--<th>Логин</th>--}}
        {{--<th>Email</th>--}}
        {{--<th>Имя</th>--}}
        {{--<th>Фамилия</th>--}}
        {{--<th>Дата регистрации</th>--}}
        {{--<th></th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
        {{--@foreach($users as $user)--}}
            {{--<tr @if(!$user->is_active) class="not-published" @endif>--}}
                {{--<td>{{ $user->id }}</td>--}}
                {{--<td>--}}
                    {{--<img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->login }}">--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--<span class="label @if($user->isAdmin()) label-success @else label-info @endif">--}}
                        {{--{{ \App\Models\User::$roles[$user->role] }}--}}
                    {{--</span>--}}
                {{--</td>--}}
                {{--<td>{{ $user->login }}</td>--}}
                {{--<td>{{ $user->email }}</td>--}}
                {{--<td>{{ $user->firstname }}</td>--}}
                {{--<td>{{ $user->lastname }}</td>--}}
                {{--<td>{{ date('j.m.Y в H:i', strtotime($user->created_at)) }}</td>--}}
                {{--<td>--}}
                    {{--<a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">--}}
                        {{--<i class="fa fa-pencil fa-lg"></i>--}}
                    {{--</a>--}}
                    {{--<a href="#" title="Удалить" data-toggle="tooltip">--}}
                        {{--<i class="fa fa-trash fa-lg"></i>--}}
                    {{--</a>--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
    {{--</tbody>--}}
{{--</table>--}}