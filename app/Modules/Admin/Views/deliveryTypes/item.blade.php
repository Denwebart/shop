<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="delivery-type form-group" data-delivery-id="{{ $deliveryType->id }}">
	<div class="col-md-6 col-sm-6">
		<a href="#" class="editable-text" data-value="{{ $deliveryType->title }}" data-name="title" data-type="text" data-pk="{{ $deliveryType->id }}" data-url="{{ route('admin.deliveryTypes.setValue') }}">{{ $deliveryType->title }}</a>
        <div class="m-t-10">
            Стоимость:
            <a href="#" class="editable-text" data-value="{{ $deliveryType->price }}" data-name="price" data-type="text" data-pk="{{ $deliveryType->id }}" data-url="{{ route('admin.deliveryTypes.setValue') }}">{{ $deliveryType->price }}</a>
            {{ Config::get('checkout.defaultCurrency.text') }}
        </div>
        <div class="m-t-10">
            <small>
                <a href="#" class="editable-text" data-value="{{ $deliveryType->description }}" data-name="description" data-type="textarea" data-pk="{{ $deliveryType->id }}" data-url="{{ route('admin.deliveryTypes.setValue') }}">{{ $deliveryType->description }}</a>
            </small>
        </div>
	</div>
	<div class="col-md-4 col-sm-4 m-t-5">
        {!! Form::file('image', ['id' => 'image-' . $deliveryType->id, 'class' => 'dropify-ajax', 'data-height' => '100', 'data-default-file' => ($deliveryType->image) ? $deliveryType->getImageUrl() : '', 'data-max-file-size' => '3M', 'data-setting-id' => $deliveryType->id, 'data-delete-url' => route('admin.deliveryTypes.deleteImage'), 'data-upload-url' => route('admin.deliveryTypes.uploadImage')]) !!}
        <span class="help-block error">
            <strong class="text"></strong>
        </span>
	</div>
	<div class="col-md-2 col-sm-2">
		<div class="switchery-demo pull-left">
			{!! Form::hidden('is_active', 0) !!}
			{!! Form::checkbox('is_active', 1, $deliveryType->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.deliveryTypes.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $deliveryType->id]) !!}
		</div>
        <a href="javascript:void(0)" class="remove-delivery pull-right" data-id="{{ $deliveryType->id }}" data-title="{{ $deliveryType->title }}" title="Удалить" data-toggle="tooltip">
            <i class="fa fa-remove fa-lg m-t-10"></i>
        </a>
	</div>
</div>