<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Настройки';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-8">
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
        <div class="col-sm-4">
        </div>
    </div>

    {{--<div class="row">--}}
        {{--<div class="col-sm-4">--}}
            {{--<div class="count-container">--}}
                {{--@include('parts.count', ['models' => $settings])--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-sm-8">--}}
            {{--<div class="sort pull-right m-b-10">--}}
                {{--<form class="form-inline">--}}
                    {{--<div class="form-group">--}}
                        {{--<input type="text" class="form-control input-sm" placeholder="Поиск...">--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div><!-- end col-->--}}
    {{--</div>--}}
    <!-- end row -->

    {{--<div class="row">--}}
        {{--<div class="col-lg-12">--}}
            {{--<div class="card-box">--}}
                {{--<div id="table-container" class="table-responsive m-b-20">--}}
                    {{--@include('admin::settings.table')--}}
                {{--</div>--}}

                {{--<div class="row">--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<div class="count-container m-t-8">--}}
                            {{--@include('parts.count', ['models' => $settings])--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<div class="pagination-container pull-right">--}}
                            {{--@include('parts.pagination', ['models' => $settings])--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div><!-- end col -->--}}
    {{--</div>--}}
    <!-- end row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Общая информация</b></h4>

                <p class="text-muted font-13 m-b-15"></p>

                <div class="form-horizontal form-editable">
                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 control-label">
                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->title }}
                        </label>
                        <div class="col-md-7 col-sm-7">
                            <a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->value }}" data-type="text" data-id="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id }}">
                                {{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->value }}
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="switchery-demo">
                                {!! Form::hidden('is_active', 0) !!}
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 control-label">
                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->title }}
                        </label>
                        <div class="col-md-7 col-sm-7">
                            <a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->value }}" data-type="text" data-id="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id }}">
                                {{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->value }}
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="switchery-demo">
                                {!! Form::hidden('is_active', 0) !!}
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 control-label">
                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->title }}
                        </label>
                        <div class="col-md-7 col-sm-7">
                            <a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->value }}" data-type="textarea" data-id="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->value }}</a>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="switchery-demo">
                                {!! Form::hidden('is_active', 0) !!}
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Социальные сети</b></h4>

                <p class="text-muted font-13 m-b-15">
                    Ссылки на группу или страницу в социальных сетях.
                </p>

                <div class="form-horizontal form-editable">
                    @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['socialButtons'] as $key => $setting)
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label">
                                <i class="fa fa-{{ $key }}"></i>
                                {{ $setting->title }}
                            </label>
                            <div class="col-md-7 col-sm-7">
                                <a href="#" class="editable-text" data-value="{{ $setting->value }}" data-type="text" data-id="{{ $setting->id }}">
                                    {{ $setting->value }}
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="switchery-demo">
                                    {!! Form::hidden('is_active', 0) !!}
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Контактная информация</b></h4>

                <p class="text-muted font-13 m-b-15">
                    Контактная информация, которая будет отображена на сайте.
                </p>

                <div class="form-horizontal form-editable">
                    @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['contactInfo'] as $key => $setting)
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label">
                                <i class="fa fa-{{ \App\Models\Setting::$contactInfoIcons[$key] }}"></i>
                                {{ $setting->title }}
                            </label>
                            <div class="col-md-7 col-sm-7">
                                <a href="#" class="editable-text" data-value="{{ $setting->value }}" data-type="text" data-id="{{ $setting->id }}">
                                    {{ $setting->value }}
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="switchery-demo">
                                    {!! Form::hidden('is_active', 0) !!}
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection

@push('styles')
    <link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />

    <!-- XEditable Plugin -->
    <link type="text/css" href="{{ asset('backend/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>

    <!-- XEditable Plugin -->
    <script src="{{ asset('backend/plugins/moment/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>


    <script type="text/javascript">
        //modify buttons style
        $.fn.editableform.buttons =
            '<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="zmdi zmdi-check"></i></button>' +
            '<button type="button" class="btn editable-cancel btn-sm waves-effect"><i class="zmdi zmdi-close"></i></button>';

        $.fn.editableform.defaults.params = function (params) {
            params._token = $("meta[name='csrf-token']").attr('content');
            return params;
        };

        // Text
        $('.editable-text').editable({
            url: "/admin/settings/set_value/" + $(this).data('id'),
            mode: 'inline',
            prepend: false,
            emptytext: 'не задано',
            defaultValue: $(this).data('value'),
            ajaxOptions: {
                dataType: 'json',
                sourceCache: 'false',
                type: 'post'
            }
            , success: function(response, newValue) {
                if(!response.success) return response.message;
            }
//            success: function(response, newValue) {
//                if(response.success) {
//                    Command: toastr["success"](response.message);
//                    return true;
//                }
//                return false;
//            }
        });
    </script>
@endpush