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
            <a href="{{ route('admin.settings.index') }}" class="btn btn-default waves-effect pull-left m-r-10">Общие настройки</a>
            <a href="{{ route('admin.settings.widgets') }}" class="btn btn-primary waves-effect pull-left m-r-10">Виджеты</a>
            <a href="{{ route('admin.settings.checkout') }}" class="btn btn-default waves-effect pull-left m-r-10">Оплата и доставка</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Слайдер</b></h4>

                <p class="text-muted font-13 m-b-15">
                    Виджет "Слайдер изображений" на главной странице сайта.
                </p>

                <a href="{{ route('admin.slider.index') }}">
                    <span>Редактировать</span>
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">
                @include('admin::workWithUs.list')
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
            }
        }
        $('.editable-text').editable(getSettingsEditableOptions());

        // Change active status or boolean value
        $('[data-plugin=switchery]').on('change', function () {
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
                data: {id: $(this).data('id'), 'value': value},
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