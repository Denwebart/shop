<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="item-user text-center card-box @if(!$user->is_active) opacity-70 @endif" data-user-id="{{ $user->id }}">
    @if(Auth::user()->isAdmin() || Auth::user()->is($user))
        <div class="dropdown pull-right">
            <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">Редактировать</a></li>
                @if($user->id != 1 && !$user->is(Auth::user()))
                    <li>
                        @if(!$user->deleted_at)
                            <a href="javascript:void(0)" class="button-delete" data-item-id="{{ $user->id }}" data-item-title="{{ $user->login }}" data-has-activities="{{ (count($user->orders) || count($user->requestedCalls) || count($user->comments) || count($user->pages) || count($user->products)) ? 1 : 0 }}">
                                Удалить
                            </a>
                        @else
                            <a href="javascript:void(0)" class="button-undelete" data-item-id="{{ $user->id }}" data-item-title="{{ $user->login }}">
                                Восстановить
                            </a>
                        @endif
                    </li>
                @endif
            </ul>
        </div>
    @endif
    <div>
        <a href="{{ route('admin.users.show', ['id' => $user->id]) }}" class="pull-left">
            <img src="{{ $user->getAvatarUrl() }}" class="img-circle thumb-xl img-thumbnail m-b-10" alt="{{ $user->login }}">
        </a>

        <div class="pull-left text-left m-l-25 m-t-15">
            @if($user->deleted_at)
                <div class="status label label-danger">Удален</div>
            @elseif(!$user->is_active)
                <div class="status label label-warning">Неактивен</div>
            @else
                <div class="status label label-success">Активен</div>
            @endif
            <br class="m-b-5">
            <span data-toggle="tooltip" title="Количество обработанных заказов.">Звказов: {{ count($user->orders) }}</span>
            <br>
            <span data-toggle="tooltip" title="Количество обработанных звонков, заказанных через сайт.">Звонков: {{ count($user->requestedCalls) }}</span>
            <br>
            <span data-toggle="tooltip" title="Колличество оставленных комментариев к товару.">Комментариев: {{ count($user->comments) }}</span>
        </div>

        <div class="clearfix"></div>

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