<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

{!! csrf_field() !!}

{!! Form::hidden('backUrl', $backUrl) !!}
{!! Form::hidden('returnBack', 1, ['id' => 'returnBack']) !!}
{!! Form::hidden('deleteImage', 0, ['id' => 'deleteImage']) !!}

<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('parent_id')) has-error @endif">
            {!! Form::label('login', 'Логин', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::text('login', $user->login, ['id' => 'login', 'class' => 'form-control']) !!}
                @if ($errors->has('login'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('login') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('email')) has-error @endif">
            {!! Form::label('email', 'Email', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::text('email', $user->email, ['id' => 'email', 'class' => 'form-control']) !!}

                @if ($errors->has('email'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('password')) has-error @endif">
            {!! Form::label('password', 'Пароль', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}

                @if ($errors->has('password'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        @if($user->isAdmin())
            <div class="form-group @if($errors->has('role')) has-error @endif">
                {!! Form::label('role', 'Права', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('role', \App\Models\User::$roles, $user->role, ['id' => 'role', 'class' => 'form-control']) !!}

                    @if ($errors->has('role'))
                        <span class="help-block error">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        @endif
        <div class="form-group @if($errors->has('firstname')) has-error @endif">
            {!! Form::label('firstname', 'Имя', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::text('firstname', $user->firstname, ['id' => 'firstname', 'class' => 'form-control']) !!}

                @if ($errors->has('firstname'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('lastname')) has-error @endif">
            {!! Form::label('lastname', 'Фамилия', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::text('lastname', $user->lastname, ['id' => 'lastname', 'class' => 'form-control']) !!}

                @if ($errors->has('lastname'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('description')) has-error @endif">
            {!! Form::label('description', 'Заметка', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::textarea('description', $user->description, ['id' => 'description', 'class' => 'form-control']) !!}

                @if ($errors->has('description'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('phone')) has-error @endif">
            {!! Form::label('phone', 'Телефон', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::tel('phone', $user->phone, ['id' => 'phone', 'class' => 'form-control']) !!}

                @if ($errors->has('phone'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15 @if($errors->has('avatar')) has-error @endif">
        {!! Form::label('avatar', 'Аватарка', ['class' => 'control-label m-b-5']) !!}
        {!! Form::file('avatar', ['id' => 'avatar', 'class' => 'dropify', 'data-default-file' => $user->getAvatarUrl(), 'data-max-file-size' => '3M']) !!}
        <span class="help-block @if($errors->has('avatar')) hidden @endif">
            <small>
                Изображение отображается перед текстом страницы
                и при выводе страниц блогом.
            </small>
        </span>
        @if ($errors->has('avatar'))
            <span class="help-block error">
                <strong>{{ $errors->first('avatar') }}</strong>
            </span>
        @endif
    </div>

</div><!-- end row -->

@push('styles')
    <link href="{{ asset('backend/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/fileuploads/js/dropify.min.js') }}"></script>

<script type="text/javascript">

    // Image Uploader
    var drEvent = $('.dropify').dropify({
        messages: {
            'default': 'Кликните или перетащите файл.',
            'replace': 'Кликните или перетащите файл для замены.',
            'remove': 'Удалить',
            'error': 'Ошибка.'
        },
        error: {
            'fileSize': 'Размер файла слишком большой (максимум 3Мб).'
        }
    });

    drEvent.on('dropify.afterClear', function(event, element){
        $('#deleteImage').val(1);
    });

    // Buttons
    $(document).on('click', '.button-save-exit', function() {
        $("#main-form").submit();
    });
    $(document).on('click', '.button-save', function() {
        $("#returnBack").val('0');
        $("#main-form").submit();
    });

</script>
@endpush