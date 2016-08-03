<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="text-center card-box">
    @if(Auth::user()->isAdmin() || Auth::user()->is($user))
        <div class="dropdown pull-right">
            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">Редактировать</a></li>
                <li>
                    @if(!$user->isAdmin() && !$user->is(Auth::user()))
                        <a href="javascript:void(0)" class="button-delete" title="Удалить" data-toggle="tooltip" data-item-id="{{ $user->id }}" data-item-title="{{ $user->login }}">
                            Удалить
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    @endif
    <div>
        <a href="{{ route('admin.users.show', ['id' => $user->id]) }}">
            <img src="{{ $user->getAvatarUrl() }}" class="img-circle thumb-xl img-thumbnail m-b-10" alt="{{ $user->login }}">
        </a>

        <p class="text-muted font-13 m-b-30">
            @if($user->description)
                {{ $user->description }}
            @else
                @if(Auth::check() && Auth::user()->is($user))
                    Расскажите немного о себе
                @endif
            @endif
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