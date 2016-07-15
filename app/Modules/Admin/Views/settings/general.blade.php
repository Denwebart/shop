<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('admin::settings.index')

@section('settingsContent')
    <div class="row m-b-20">
        <div class="col-md-12">
            <a href="{{ route('admin.settings.index') }}" class="btn btn-primary waves-effect pull-left m-r-10">Общие настройки</a>
            <a href="{{ route('admin.settings.widgets') }}" class="btn btn-default waves-effect pull-left m-r-10">Виджеты</a>
            <a href="{{ route('admin.settings.checkout') }}" class="btn btn-default waves-effect pull-left m-r-10">Оплата и доставка</a>
            <a href="{{ route('admin.settings.properties') }}" class="btn btn-default waves-effect pull-left m-r-10">Характеристики товаров</a>
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
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id]) !!}
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
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id]) !!}
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
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->id]) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::open(['files' => true]) !!}
                    @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['logo'] as $key => $setting)
                        <div class="form-group settings image-container @if($key != 'main') dark @endif" data-image-setting-id="{{ $setting->id }}">
                            <label class="col-md-3 col-sm-3 control-label">
                                {{ $setting->title }}
                                @if($setting->description)
                                    <small>{{ $setting->description }}</small>
                                @endif
                            </label>
                            <div class="col-md-7 col-sm-7">
                                {!! Form::file('logo.' . $key, ['id' => 'logo.' . $key, 'class' => 'dropify-ajax', 'data-height' => '100', 'data-default-file' => ($setting->value) ? asset('images/' . $setting->value) : '', 'data-max-file-size' => '3M', 'data-setting-id' => $setting->id, 'data-delete-url' => route('admin.settings.deleteImage'), 'data-upload-url' => route('admin.settings.uploadImage')]) !!}
                                <span class="help-block error">
                                        <strong class="text"></strong>
                                    </span>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="switchery-demo">
                                    {!! Form::hidden('is_active', 0) !!}
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {!! Form::close() !!}

                <!-- Мета-данные -->
                    <h4 class="header-title m-t-0 m-b-10"><b>Мета-теги</b></h4>
                    <p class="text-muted font-13 m-b-15">
                        Предназначены исключительно для поисковых систем.
                        Не отображаются на странице сайта. <br>
                    </p>
                    <div class="form-horizontal form-editable">
                        @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['meta'] as $key => $setting)
                            @if(in_array($key, ['robots','author','copyright']))
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 control-label" title="{{ $setting->description }}" data-toggle="tooltip">
                                        {{ $setting->title }}
                                    </label>
                                    <div class="col-md-7 col-sm-7">
                                        <a href="#" class="editable-text" data-value="{{ $setting->value }}" @if($key == 'robots') data-type="text" @else data-type="textarea" @endif data-pk="{{ $setting->id }}">{{ $setting->value }}</a>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="switchery-demo">
                                            {!! Form::hidden('is_active', 0) !!}
                                            {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{--<p class="text-muted font-13 m-b-15">--}}
                    {{--Мета-теги title, description, keywords будут использованы в том случае,--}}
                    {{--если мета-данные страницы не будут заполнены.<br>--}}
                    {{--</p>--}}
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
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
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
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <h5 class="header-title m-t-20 m-b-10"><b>Координаты на карте</b></h5>
                <p class="text-muted font-13 m-b-15">
                    Карта будет отображена на странице с контактами только в том случае,
                    если заполнены и включены обе настройки.
                </p>

                <div class="form-horizontal form-editable">
                    @foreach($settings[\App\Models\Setting::CATEGORY_CONTACT_PAGE]['map'] as $key => $setting)
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label">
                                {{ $setting->title }}
                            </label>
                            <div class="col-md-7 col-sm-7">
                                <a href="#" class="editable-text" data-value="{{ $setting->value }}" data-type="text" data-pk="{{ $setting->id }}">{{ $setting->value }}</a>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="switchery-demo">
                                    {!! Form::hidden('is_active', 0) !!}
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Системные настроки</b></h4>

                <p class="text-muted font-13 m-b-15">

                </p>

                <div class="form-horizontal form-editable">
                    @foreach($settings[\App\Models\Setting::CATEGORY_SYSTEM]['premoderation'] as $key => $setting)
                        <div class="form-group">
                            <label class="col-md-10 col-sm-10 control-label">
                                {{ $setting->title }}
                                @if($setting->description)
                                    <small>{{ $setting->description }}</small>
                                @endif
                            </label>
                            <div class="col-md-2 col-sm-2">
                                <div class="switchery-demo">
                                    {!! Form::hidden('value', 0) !!}
                                    {!! Form::checkbox('value', 1, $setting->value, ['id' => 'value', 'data-plugin' => 'switchery', 'data-url' => route('admin.settings.setValue'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">
                @include('admin::menus.menu')
            </div>
        </div><!-- end col -->
    </div>
@endsection

@push('styles')
    <link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- XEditable Plugin -->
    <link type="text/css" href="{{ asset('backend/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/fileuploads/js/dropify.min.js') }}"></script>

    <script type="text/javascript">

        // Image Uploader
        var dropifyAjax = $('.dropify-ajax').dropify(dropifyOptions);

        dropifyAjax.on('dropify.fileReady', function(event, element) {
            var settingId = $(this).data('settingId');
            var url = $(this).data('uploadUrl') ? $(this).data('uploadUrl') : "{{ route('admin.settings.uploadImage') }}";
            var data = new FormData();
            data.append("id", settingId);
            data.append("image", $(this)[0].files[0]);
            $.ajax({
                url: url,
                dataType: "json",
                processData: false,
                contentType: false,
                type: "POST",
                data: data,
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    var $imageContainer = $('[data-image-setting-id="' + settingId + '"]');
                    $imageContainer.removeClass('has-error');
                    $imageContainer.find('.error .text').text('');

                    if(response.success){
                        Command: toastr["success"](response.message);
                    } else {
                        Command: toastr["error"](response.message);

                        $imageContainer.addClass('has-error');
                        $imageContainer.find('.error .text').text(response.error);
                    }
                }
            });
        });

        dropifyAjax.on('dropify.beforeClear', function(event, element) {
            var settingId = $(this).data('settingId');
            var url = $(this).data('deleteUrl') ? $(this).data('deleteUrl') : "{{ route('admin.settings.deleteImage') }}";
            $.ajax({
                url: url,
                dataType: "text json",
                type: "POST",
                data: {id: settingId},
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success){
                        Command: toastr["success"](response.message);

                        var $imageContainer = $('[data-image-setting-id="' + settingId + '"]');
                        $imageContainer.removeClass('has-error');
                        $imageContainer.find('.error .text').text('');
                    } else {
                        Command: toastr["error"](response.message);
                    }
                }
            });
        });

    </script>

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

        // Edit settings
        function getSettingsEditableOptions() {
            return {
                url: "{{ route('admin.settings.setValue') }}",
                mode: 'inline',
                prepend: false,
                emptytext: 'не задано',
                ajaxOptions: {
                    dataType: 'json',
                    sourceCache: 'false',
                    type: 'POST'
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
            }
        }
        $('.editable-text').editable(getSettingsEditableOptions());

        // Change active status or boolean value
        $('[data-plugin=switchery], .ajax-checkbox').on('change', function () {
            if($(this).is(':checked')) {
                var value = 1;
            } else {
                var value = 0;
            }
            var url = $(this).data('url') ? $(this).data('url') : "{{ route('admin.settings.setIsActive') }}";
            $.ajax({
                url: url,
                dataType: "text json",
                type: "POST",
                data: {id: $(this).data('id'), value: value, name: $(this).attr('name')},
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