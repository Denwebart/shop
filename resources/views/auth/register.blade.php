@extends('layouts.login')

@section('content')
    <div class="m-t-40 card-box">
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">Регистрация</h4>
        </div>
        <div class="panel-body">
            <form method="POST" class="form-horizontal m-t-20" action="{{ url('/register') }}">

                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input name="login" value="{{ old('name') }}" class="form-control" type="text" required="" placeholder="Логин">

                        @if ($errors->has('login'))
                            <span class="help-block">
                                <strong>{{ $errors->first('login') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input name="email" value="{{ old('email') }}" class="form-control" type="email" required="" placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input name="password" class="form-control" type="password" required="" placeholder="Пароль">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <div class="col-xs-12">
                        <input name="password_confirmation" class="form-control" type="password" required="" placeholder="Подтверждение пароля">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
                            Зарегистрироваться
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
    <!-- end card-box -->

    <div class="row">
        <div class="col-sm-12 text-center">
            <p class="text-muted">
                Есть аккаунт?
                <a href="{{ url('/login') }}" class="text-primary m-l-5">
                    <b>Войти</b>
                </a>
            </p>
        </div>
    </div>
@endsection
