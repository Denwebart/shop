<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Редактирование настройки "' . $setting->title . '"';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-6 col-md-6 col-xs-12 hidden-xs">
            <ul class="breadcrumb m-b-10">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li><a href="{{ route('admin.settings.index') }}">Настройки</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
        <div class="col-sm-6 col-md-6 col-xs-12">
            <div class="button pull-right">
                <button type="button" class="btn btn-success btn-bordred waves-effect waves-light m-b-10 button-save-exit">
                    <i class="fa fa-arrow-left"></i>
                    <span>Сохранить и выйти</span>
                </button>
                <button type="button" class="btn btn-success btn-bordred waves-effect waves-light m-b-10 button-save">
                    <i class="fa fa-check"></i>
                    <span class="hidden-sm">Сохранить</span>
                </button>
                <a href="{{ $backUrl }}" class="btn btn-primary btn-bordred waves-effect waves-light m-b-10 button-cancel">
                    <i class="fa fa-close"></i>
                    <span class="hidden-md hidden-sm">Отмена</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                {!! Form::model($setting, ['route' => ['admin.settings.update', $setting->id], 'class' => 'form-horizontal', 'id' => 'main-form']) !!}
                {!! Form::hidden('_method', 'PUT') !!}
                
                {!! csrf_field() !!}

                {!! Form::hidden('backUrl', $backUrl) !!}
                {!! Form::hidden('returnBack', 1, ['id' => 'returnBack']) !!}
                
                <div class="row">
                    <div class="col-lg-4 col-sm-12 col-xs-12 m-b-15">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="m-t-0 pull-left">
                                    {{ $setting->title }}
                                </h4>
                                <div class="clearfix"></div>
                                {{ $setting->description }}
                            </div>
                        </div>

                        <div class="row m-t-20">
                            <div class="col-md-3"><small>Категория:</small></div>
                            <div class="col-md-9">
                                <small>{{ \App\Models\Setting::$categories[$setting->category] }}</small>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-8 col-sm-12 col-xs-12 m-b-15">
                        <div class="form-group @if($errors->has('is_active')) has-error @endif">
                            <div class="switchery-demo m-b-5">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-4">
                                    {!! Form::hidden('is_active', 0) !!}
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                                    {!! Form::label('is_active', 'Включена', ['class' => 'control-label m-l-5']) !!}
                                </div>
                                <div class="col-md-6">
                                    @if($setting->updated_at)
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::label('updated_at', 'Последнее обновление', ['class' => 'control-label']) !!}
                                            </div>
                                            <div class="col-md-6">
                                                {{ \App\Helpers\Date::format($setting->updated_at) }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if ($errors->has('is_active'))
                                    <span class="help-block error">
                                        <strong>{{ $errors->first('is_active') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if($errors->has('value')) has-error @endif">
                            {!! Form::label('value', 'Значение', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-10">

                                @if($setting->type == \App\Models\Setting::TYPE_BOOLEAN)
                                    {!! Form::hidden('value', 0) !!}
                                    {!! Form::checkbox('value', 1, $setting->value, ['id' => 'value', 'data-plugin' => 'switchery', 'data-color' => '#3bafda']) !!}
                                @elseif($setting->type == \App\Models\Setting::TYPE_INTEGER)
                                    {!! Form::text('value', $setting->value, ['id' => 'value', 'class' => 'form-control']) !!}

                                    @push('styles')
                                        <link href="{{ asset('backend/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
                                    @endpush

                                    @push('scripts')
                                        <script src="{{ asset('backend/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
                                        <script type="text/javascript">
                                            $("input[name='value']").TouchSpin({
                                                buttondown_class: "btn btn-primary",
                                                buttonup_class: "btn btn-primary"
                                            });
                                        </script>
                                    @endpush
                                @elseif($setting->type == \App\Models\Setting::TYPE_HTML)
                                    {!! Form::text('value', $setting->value, ['id' => 'value', 'class' => 'form-control editor']) !!}

                                    @push('styles')
                                    <link href="{{ asset('backend/plugins/summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
                                    @endpush

                                    @push('scripts')
                                    <script src="{{ asset('backend/plugins/summernote/summernote.min.js') }}"></script>
                                    <script src="{{ asset('backend/plugins/summernote/lang/summernote-ru-RU.js') }}"></script>
                                    <script type="text/javascript">
                                        // WYSIWYG
                                        $(document).ready(function() {
                                            $('.editor').summernote({
                                                lang: 'ru-RU',
                                                height: 300,                 // set editor height
                                                minHeight: null,             // set minimum height of editor
                                                maxHeight: null,             // set maximum height of editor
                                                focus: false                  // set focus to editable area after initializing summernote
                                            });
                                        });
                                    </script>
                                    @endpush
                                @elseif($setting->type == \App\Models\Setting::TYPE_STRING)
                                    {!! Form::text('value', $setting->value, ['id' => 'value', 'class' => 'form-control']) !!}
                                @else
                                    {!! Form::textarea('value', $setting->value, ['id' => 'value', 'class' => 'form-control', 'row' => 7]) !!}
                                @endif

                                @if ($errors->has('value'))
                                    <span class="help-block error">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><!-- end col -->

                </div><!-- end row -->

                {!! Form::close() !!}
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->

@endsection

@push('styles')
    <link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>

    <script type="text/javascript">
        // Buttons
        $(document).on('click', '.button-save-exit', function() {
            $("#returnBack").val('1');
            $("#main-form").submit();
        });
        $(document).on('click', '.button-save', function() {
            $("#returnBack").val('0');
            $("#main-form").submit();
        });
    </script>
@endpush