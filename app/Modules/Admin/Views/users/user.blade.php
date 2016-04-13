<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="text-center card-box">
    <div class="dropdown pull-right">
        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-cog"></i>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">Редактировать</a></li>
            <li><a href="#">Удалить</a></li>
        </ul>
    </div>
    <div>
        <a href="{{ route('admin.users.show', ['id' => $user->id]) }}">
            <img src="{{ $user->getAvatarUrl() }}" class="img-circle thumb-xl img-thumbnail m-b-10" alt="{{ $user->login }}">
        </a>

        <p class="text-muted font-13 m-b-30">
            {{ $user->description or 'Расскажите немного о себе' }}
        </p>

        <div class="text-left">
            <p class="text-muted font-13"><strong>Логин :</strong> <span class="m-l-15">{{ $user->login }}</span></p>

            <p class="text-muted font-13"><strong>Имя и фамилия :</strong><span class="m-l-15">{{ $user->getFullName() }}</span></p>

            <p class="text-muted font-13"><strong>Телефон :</strong><span class="m-l-15">{{ $user->getPhone() }}</span></p>

            <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ $user->email }}</span></p>

            <p class="text-muted font-13"><strong>Права :</strong> <span class="label label-{{ \App\Models\User::$rolesClass[$user->role] }} m-l-15">{{ \App\Models\User::$roles[$user->role] }}</span></p>

            <p class="text-muted font-13"><strong>Дата регистрации :</strong> <span class="m-l-15">{{ \App\Helpers\Date::getRelative($user->created_at) }}</span></p>
        </div>
    </div>
</div>