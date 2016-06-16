<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
$title = 'Восстановление пароля';
View::share('title', $title);
?>

@extends('layouts.login')

<!-- Main Content -->
@section('content')
    <div class="m-t-40 card-box">
        @if (session('status'))
            <div class="panel-body text-center">
                <img src="{{ asset('backend/images/mail_confirm.png') }}" alt="img" class="thumb-lg center-block" />
                <p class="text-muted font-13 m-t-20">
                    {{ session('status') }}
                </p>
            </div>
        @else
            <div class="text-center">
                <h4 class="text-uppercase font-bold m-b-0">{{ $title }}</h4>

                <p class="text-muted m-b-0 font-13 m-t-20">
                    Введите Ваш email-адрес для получения письма со ссылкой для смены пароля.
                </p>
            </div>
            <div class="panel-body">

                <form method="POST" class="form-horizontal m-t-20" action="{{ url('/password/email') }}">

                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input name="email" class="form-control" type="email" required="" placeholder="Email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20 m-b-0">
                        <div class="col-xs-12">
                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                                Отправить письмо
                            </button>
                        </div>
                    </div>

                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-sm-12">
                            <a href="{{ url('login') }}" class="text-muted">
                                <i class="fa fa-sign-out m-r-5"></i>
                                Вход
                            </a>
                        </div>
                    </div>

                </form>

            </div>
        @endif
    </div>
    <!-- end card-box -->
@endsection
