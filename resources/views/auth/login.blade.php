<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
$title = 'Вход';
View::share('title', $title);
?>

@extends('layouts.login')

@section('content')
    <div class="m-t-40 card-box">
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">{{ $title }}</h4>
        </div>
        <div class="panel-body">
            <form method="POST" class="form-horizontal m-t-20" action="{{ URL::to('login') }}">

                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input name="email" value="{{ old('email') }}" class="form-control" type="text" placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="help-block error">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input name="password" class="form-control" type="password" placeholder="Пароль">

                        @if ($errors->has('password'))
                            <span class="help-block error">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-custom">
                            <input name="remember" id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Запомнить меня
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                            Войти
                        </button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="{{ url('/password/reset') }}" class="text-muted">
                            <i class="fa fa-lock m-r-5"></i>
                            Забыли пароль?
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- end card-box-->
@endsection
