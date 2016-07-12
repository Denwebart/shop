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
            <a href="{{ route('admin.settings.widgets') }}" class="btn btn-default waves-effect pull-left m-r-10">Виджеты</a>
            <a href="{{ route('admin.settings.checkout') }}" class="btn btn-default waves-effect pull-left m-r-10">Оплата и доставка</a>
            <a href="{{ route('admin.settings.properties') }}" class="btn btn-primary waves-effect pull-left m-r-10">Характеристики товаров</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card-box">
                <div id="properties-container">
                    @include('admin::properties.properties')
                </div>

                <div class="bg-muted p-20">
                    <a href="javascript:void(0)" class="show-properties-form pull-right">
                        <span class="m-t-3 pull-left">Добавить новую характеристику</span>
                        <i class="fa fa-plus fa-2x pull-left m-l-10"></i>
                    </a>
                    <div class="clearfix"></div>

                    {!! Form::open(['url' => route('admin.properties.add'), 'class' => 'form-horizontal m-t-30', 'id' => 'properties-form', 'style' => "display: none"]) !!}
                        <p class="text-muted font-13 m-b-15">
                            Для создания новой характеристики введите название характеристики и нажмите "Добавить".
                        </p>
                        <div class="input-group input-group-two-fields m-t-10">
                            {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'new-property-title']) !!}
                            {!! Form::select('type', \App\Models\Property::$types, null, ['class' => 'form-control', 'id' => 'new-property-type']) !!}
                            <span class="input-group-btn">
                                <button type="button" class="add-property btn waves-effect waves-light btn-success">Добавить</button>
                            </span>
                        </div>
                        <div class="help-block error title_error input-group-two-fields"></div>
                        <div class="help-block error type_error input-group-two-fields"></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-5">

        </div><!-- end col -->
    </div>
@endsection

@push('styles')
    <link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- XEditable Plugin -->
    <link type="text/css" href="{{ asset('backend/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
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

    <script src="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
    <script type="text/javascript">
        !function ($) {
            "use strict";

            // Properties
            // Open form
            $(document).on('click', '.show-properties-form', function() {
                var $form = $("#properties-form");
                if($form.is(':visible')) {
                    $form.hide();
                } else {
                    $form.show();
                }
            });
            $(document).on('click', '.add-property', function(){
                $("#properties-form").submit();
            });

            $(document).on('submit', '#properties-form', function(event){
                event.preventDefault ? event.preventDefault() : event.returnValue = false;

                var $form = $(this),
                    formData = $form.serialize(),
                    url = $form.attr('action');

                $.ajax({
                    url: url,
                    dataType: "json",
                    type: "POST",
                    data: formData,
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        $form.find('.has-error').removeClass('has-error');
                        $form.find('.help-block.error').text('');

                        if(response.success){
                            $form.trigger('reset');
                            Command: toastr["success"](response.message);
                            $('#properties-container').html(response.propertiesHtml);
                            $form.hide();
                        } else {
                            $.each(response.errors, function(index, value) {
                                var errorDiv = '.' + index + '_error';
                                $form.find('[name='+ index +']').addClass('has-error');
                                $form.find(errorDiv).empty().append(value);
                            });
                            Command: toastr["error"](response.message);
                        }
                    }
                });
            });

            $(document).on('click', '.remove-property', function(event) {
                event.preventDefault ? event.preventDefault() : event.returnValue = false;

                var itemId = $(this).data('propertyId'),
                    itemTitle = $(this).data('title'),
                    countValues = $(this).data('countValues'),
                    countProducts = $(this).data('countProducts');

                var text = '';
                if(countValues) {
                    text = '\n Характеристика имеет '+ countValues +', все значения будут удалены.';
                }
                if(countProducts) {
                    text = '\n Характеристика имеет '+ countValues +' и добавлена на ' + countProducts + ', все связи и значения будут удалены.';
                }

                sweetAlert(
                {
                    title: "Удалить характеристику?",
                    text: 'Вы точно хотите удалить характеристику товара "'+ itemTitle +'"?' + text,
                    type: "error",
                    showCancelButton: true,
                    cancelButtonText: 'Отмена',
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    confirmButtonText: 'Удалить'
                }, function(){
                    $.ajax({
                        url: "{{ route('admin.properties.remove') }}",
                        dataType: "json",
                        type: "POST",
                        data: {id: itemId},
                        beforeSend: function (request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function(response) {
                            if(response.success){
                                Command: toastr["success"](response.message);
                                $('#properties-container').find(".property[data-property-id='" + itemId + "']").remove();
                            } else {
                                Command: toastr["error"](response.message);
                            }
                        }
                    });
                });
            });
            // End Properties

            // Property Values
            // Open form
            $(document).on('click', '.show-property-value-form', function (e) {
                e.preventDefault();
                var propertyId = $(this).data('propertyId'),
                    $form = $('.new-property-value-form[data-property-id='+ propertyId +']');
                if($form.is(':visible')) {
                    $form.hide();
                } else {
                    $('.new-property-value-form').hide();
                    $form.show();
                }
            });
            $(document).on('click', '.add-property-value', function(){
                var propertyId = $(this).data('propertyId');
                $('.new-property-value-form[data-property-id='+ propertyId +']').submit();
            });

            $(document).on('submit', '.new-property-value-form', function(event){
                event.preventDefault ? event.preventDefault() : event.returnValue = false;

                var $form = $(this),
                    propertyId = $(this).data('propertyId'),
                    inputValue = $form.find('[name=value]').val(),
                    url = $form.attr('action');

                $.ajax({
                    url: url,
                    dataType: "json",
                    type: "POST",
                    data: {property_id: propertyId, value: inputValue},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        $form.find('.has-error').removeClass('has-error');
                        $form.find('.help-block.error').text('');

                        if(response.success){
                            $form.trigger('reset');
                            Command: toastr["success"](response.message);
                            $('.property-values-container[data-property-id='+ propertyId +']').html(response.propertyValuesHtml);
                            $form.hide();
                        } else {
                            $.each(response.errors, function(index, value) {
                                var errorDiv = '.' + index + '_error';
                                $form.find('[name='+ index +']').addClass('has-error');
                                $form.find(errorDiv).empty().append(value);
                            });
                            Command: toastr["error"](response.message);
                        }
                    }
                });
            });

            $(document).on('click', '.remove-property-value', function(event) {
                event.preventDefault ? event.preventDefault() : event.returnValue = false;

                var valueId = $(this).data('valueId'),
                    valueTitle = $(this).data('valueTitle'),
                    propertyTitle = $(this).data('propertyTitle'),
                    countProducts = $(this).data('countProducts');

                var text = '';
                if(countProducts) {
                    text = '\n Значение добавлено на ' + countProducts + ', все связи будут удалены.';
                }

                sweetAlert(
                {
                    title: "Удалить значение?",
                    text: 'Вы точно хотите удалить значение '+ valueTitle +' характеристики "'+ propertyTitle +'"?' + text,
                    type: "error",
                    showCancelButton: true,
                    cancelButtonText: 'Отмена',
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    confirmButtonText: 'Удалить'
                }, function(){
                    $.ajax({
                        url: "{{ route('admin.properties.removeValue') }}",
                        dataType: "json",
                        type: "POST",
                        data: {id: valueId},
                        beforeSend: function (request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function(response) {
                            if(response.success){
                                Command: toastr["success"](response.message);
                                $('#properties-container').find(".property-value[data-value-id='" + valueId + "']").remove();
                            } else {
                                Command: toastr["error"](response.message);
                            }
                        }
                    });
                });
            });
            // End Property Values
        }(window.jQuery);
    </script>
@endpush