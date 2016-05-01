<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Настройки сайта';
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

    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Общая информация</b></h4>

                <p class="text-muted font-13 m-b-15"></p>

                <div class="form-horizontal form-editable">
                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 control-label">
                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->title }}
                            @if($settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->description)
                                <small>{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->description }}</small>
                            @endif
                        </label>
                        <div class="col-md-7 col-sm-7">
                            <a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->value }}" data-type="textarea" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->value }}</a>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="switchery-demo">
                                {!! Form::hidden('is_active', 0) !!}
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 control-label">
                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->title }}
                            @if($settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->description)
                                <small>{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->description }}</small>
                            @endif
                        </label>
                        <div class="col-md-7 col-sm-7">
                            <a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->value }}" data-type="textarea" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->value }}</a>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="switchery-demo">
                                {!! Form::hidden('is_active', 0) !!}
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 control-label">
                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->title }}
                            @if($settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->description)
                                <small>{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->description }}</small>
                            @endif
                        </label>
                        <div class="col-md-7 col-sm-7">
                            <a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->value }}" data-type="textarea" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->value }}</a>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="switchery-demo">
                                {!! Form::hidden('is_active', 0) !!}
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->id]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Социальные сети</b></h4>

                <p class="text-muted font-13 m-b-15">
                    Ссылки на группу или страницу в социальных сетях.
                </p>

                <div class="form-horizontal form-editable">
                    @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['socialButtons'] as $key => $setting)
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label" title="{{ $setting->description }}" data-toggle="tooltip">
                                <i class="fa fa-{{ $key }}"></i>
                                {{ $setting->title }}
                            </label>
                            <div class="col-md-7 col-sm-7">
                                <a href="#" class="editable-text" data-value="{{ $setting->value }}" data-type="text" data-pk="{{ $setting->id }}">
                                    {{ $setting->value }}
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="switchery-demo">
                                    {!! Form::hidden('is_active', 0) !!}
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
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
                                @if($setting->description)
                                    <small>{{ $setting->description }}</small>
                                @endif
                            </label>
                            <div class="col-md-7 col-sm-7">
                                <a href="#" class="editable-text" data-value="{{ $setting->value }}" @if($setting->type == \App\Models\Setting::TYPE_TEXT) data-type="textarea" @else data-type="text" @endif data-pk="{{ $setting->id }}">{{ $setting->value }}</a>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="switchery-demo">
                                    {!! Form::hidden('is_active', 0) !!}
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Меню сайта</b></h4>

            </div>

            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Слайдер</b></h4>

                <a href="{{ route('admin.slider.index') }}">
                    <span>Редактировать</span>
                </a>
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
            url: "{{ route('admin.settings.setValue') }}",
            mode: 'inline',
            prepend: false,
            emptytext: 'не задано',
            ajaxOptions: {
                dataType: 'json',
                sourceCache: 'false',
                type: 'PUT'
            },
            success: function(response, newValue) {
                if(response.success) {
                    Command: toastr["success"](response.message);
                    return true;
                } else {
                    Command: toastr["error"](response.message);
                    return response.error;
                }
                return false;
            }
        });

        // Change active ststus
        $('[data-plugin=switchery]').on('change', function () {
            if($(this).is(':checked')) {
                var isActive = 1;
            } else {
                var isActive = 0;
            }
            $.ajax({
                url: "{{ route('admin.settings.setIsActive') }}",
                dataType: "text json",
                type: "POST",
                data: {id: $(this).data('id'), 'is_active': isActive},
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success){
                        Command: toastr["success"](response.message);
                    } else {
                        Command: toastr["error"](response.message);
                    }
                }
            });
        });
    </script>
@endpush