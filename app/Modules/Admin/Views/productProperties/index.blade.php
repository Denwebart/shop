<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div id="product-properties-container" class="form-horizontal form-editable">
            @foreach($productProperties as $key => $property)
                @include('admin::productProperties.item')
            @endforeach
        </div>

        <a href="javascript:void(0)" class="show-product-properties-form pull-right">
            <span class="m-t-3 pull-left">Добавить</span>
            <i class="fa fa-plus fa-2x pull-left m-l-10"></i>
        </a>
        <div class="clearfix"></div>

        {!! Form::open(['url' => route('admin.productProperties.add'), 'class' => 'form-horizontal m-t-30', 'id' => 'product-properties-form', 'files' => true, 'style' => "display: none"]) !!}
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="form-group m-0">
                    {!! Form::label('title', 'Название', ['class' => 'control-label m-b-5']) !!}
                    {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'rows' => 2]) !!}

                    <span class="help-block error title_error">
                        {{ $errors->first('title') }}
                    </span>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group m-0">
                    {!! Form::label('value', 'Значение', ['class' => 'control-label m-b-5']) !!}
                    {!! Form::text('value', null, ['id' => 'description', 'class' => 'form-control', 'rows' => 5]) !!}

                    <span class="help-block error description_error">
                        {{ $errors->first('value') }}
                    </span>
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <button type="button" class="btn btn-success btn-bordred waves-effect waves-light m-b-10 button-save-product-property pull-right">
                    <i class="fa fa-check"></i>
                    <span class="hidden-sm">Сохранить</span>
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@push('styles')
<link href="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
<script type="text/javascript">
	!function ($) {
		"use strict";

		// Open form
		$(".show-product-properties-form").on('click', function() {
			var $form = $("#product-properties-form");
			if($form.is(':visible')) {
				$form.hide();
			} else {
				$form.show();
			}
		});

		$('.button-save-product-property').on('click', function(){
			$("#product-properties-form").submit();
		});

		$('#product-properties-form').on('submit', function(event){
			event.preventDefault ? event.preventDefault() : event.returnValue = false;

			var $form = $(this),
				formData = $form.serializeArray(),
				url = $form.attr('action');

			$.each(params, function(i, val) {
				formData.append(val.name, val.value);
			});

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
						$('#product-properties-container').append(response.itemHtml);
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

		$(document).on('click', '.remove-product-property', function() {
			var itemId = $(this).data('id'),
				itemTitle = $(this).data('title');

			sweetAlert({
				title: "Удалить способ доставки?",
				text: 'Вы точно хотите удалить способ доставки "'+ itemTitle +'"?',
				type: "error",
				showCancelButton: true,
				cancelButtonText: 'Отмена',
				confirmButtonClass: 'btn-danger waves-effect waves-light',
				confirmButtonText: 'Удалить'
			}, function(){
				$.ajax({
					url: "{{ route('admin.productProperties.remove') }}",
					dataType: "json",
					type: "POST",
					data: {id: itemId},
					beforeSend: function (request) {
						return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
					},
					success: function(response) {
						if(response.success){
							Command: toastr["success"](response.message);
							$('#product-properties-container').find("[data-delivery-id='" + itemId + "']").remove();
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