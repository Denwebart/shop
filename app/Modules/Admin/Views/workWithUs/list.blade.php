<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<h4 class="header-title m-t-0 m-b-10"><b>С нами сотрудничают</b></h4>

<p class="text-muted font-13 m-b-15">
	Виджет "С нами сотрудничают" на главной странице сайта.
    <br>
    Рекомендуемая ширина изображения - <strong>350px</strong>.
</p>

<div id="work-with-us-container" class="form-horizontal form-editable">
    @include('admin::workWithUs.items')
</div>

<div class="bg-muted p-20 m-t-20">
    <a href="javascript:void(0)" class="show-work-with-us-form pull-right">
        <span class="m-t-3 pull-left">Добавить</span>
        <i class="fa fa-plus fa-2x pull-left m-l-10"></i>
    </a>
    <div class="clearfix"></div>

    {!! Form::open(['url' => route('admin.workWithUs.add'), 'class' => 'form-horizontal m-t-30', 'id' => 'work-with-us-form', 'files' => true, 'style' => "display: none"]) !!}
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="form-group m-0">
                    {!! Form::label('title', 'Заголовок', ['class' => 'control-label m-b-5']) !!}
                    {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'rows' => 2]) !!}

                    <span class="help-block error title_error">
                        {{ $errors->first('title') }}
                    </span>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="form-group m-0">
                    {!! Form::label('image', 'Изображение', ['class' => 'control-label m-b-5']) !!}
                    {!! Form::file('image', ['id' => 'image', 'class' => 'dropify', 'data-default-file' => false, 'data-height' => '100', 'data-max-file-size' => '3M']) !!}
                    <span class="help-block error image_error"></span>
                </div>

                <small class="help-block">
                    Рекомендуемая ширина изображения - <strong>350px</strong>.
                </small>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="form-group m-t-25 m-r-0 m-l-0">
                    <div class="switchery-demo m-b-5">
                        {!! Form::hidden('is_published', 0) !!}
                        {!! Form::checkbox('is_published', 1, null, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <button type="button" class="btn btn-success btn-bordred waves-effect waves-light m-b-10 button-save-work-with-us pull-right">
                    <i class="fa fa-check"></i>
                    <span class="hidden-sm">Сохранить</span>
                </button>
            </div>
        </div>
    {!! Form::close() !!}
</div>
<div class="clearfix"></div>

@push('styles')
    <link href="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
    <script type="text/javascript">
        !function ($) {
            "use strict";

            // Open form
            $(".show-work-with-us-form").on('click', function() {
                var $form = $("#work-with-us-form");
                if($form.is(':visible')) {
                    $form.hide();
                } else {
                    $form.show();
                }
            });

            var dropify = $('.dropify').dropify(dropifyOptions);

            $('.button-save-work-with-us').on('click', function(){
                $("#work-with-us-form").submit();
            });

            $('#work-with-us-form').on('submit', function(event){
                event.preventDefault ? event.preventDefault() : event.returnValue = false;

                var $form = $(this),
                        formData = new FormData(),
                        params   = $form.serializeArray(),
                        image    = $form.find('[name="image"]')[0].files[0],
                        url = $form.attr('action');

                $.each(params, function(i, val) {
                    formData.append(val.name, val.value);
                });
                if(image) {
                    formData.append('image', image);
                }

                $.ajax({
                    url: url,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    type: "POST",
                    data: formData,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        $form.find('.has-error').removeClass('has-error');
                        $form.find('.help-block.error').text('');

                        if(response.success){
                            $form.trigger('reset');
                            Command: toastr["success"](response.message);
                            $('#work-with-us-container').html(response.itemsHtml);
                            $form.hide();
                            $.Components.init();
                            setIsActive();

                            // доделать навешивание dropify и switchery после добавления нового
                            dropifyAjax = $('.dropify-ajax').dropify(dropifyOptions);
                            $('.editable-text').editable(getSettingsEditableOptions());
                        } else {
                            $.each(response.errors, function(index, value) {
                                var errorDiv = '.' + index + '_error';
                                $form.find(errorDiv).parent().addClass('has-error');
                                $form.find(errorDiv).empty().append(value);
                            });
                            Command: toastr["error"](response.message);
                        }
                    }
                });
            });

            $(document).on('click', '.remove-work-with-us', function() {
                var itemId = $(this).data('id'),
                    itemTitle = $(this).data('title');

                sweetAlert(
                    {
                        title: "Удалить значение?",
                        text: 'Вы точно хотите удалить значение "'+ itemTitle +'"?',
                        type: "error",
                        showCancelButton: true,
                        cancelButtonText: 'Отмена',
                        confirmButtonClass: 'btn-danger waves-effect waves-light',
                        confirmButtonText: 'Удалить'
                    }, function(){
                        $.ajax({
                            url: "{{ route('admin.workWithUs.remove') }}",
                            dataType: "json",
                            type: "POST",
                            data: {id: itemId},
                            beforeSend: function (request) {
                                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                            },
                            success: function(response) {
                                if(response.success){
                                    Command: toastr["success"](response.message);
                                    $('#work-with-us-container').find("[data-work-with-us-id='" + itemId + "']").remove();
                                } else {
                                    Command: toastr["error"](response.message);
                                }
                            }
                        });
                    });
            });
        }(window.jQuery);
    </script>
@endpush