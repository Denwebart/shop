<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<h4 class="header-title m-t-0 m-b-10"><b>Оплата и доставка</b></h4>

<p class="text-muted font-13 m-b-15">
	Способы оставки и оплаты.
</p>

<div class="form-horizontal form-editable">
	@foreach(\App\Models\DeliveryType::all() as $key => $deliveryType)
	<div class="form-group">
		<div class="col-md-6 col-sm-6 control-label">
			<a href="#" class="editable-text" data-value="{{ $deliveryType->title }}" data-name="title" data-type="text" data-pk="{{ $deliveryType->id }}" data-url="{{ route('admin.deliveryTypes.setValue') }}">{{ $deliveryType->title }}</a>
			<small class="m-t-10">
				<a href="#" class="editable-text" data-value="{{ $deliveryType->description }}" data-name="description" data-type="textarea" data-pk="{{ $deliveryType->id }}" data-url="{{ route('admin.deliveryTypes.setValue') }}">{{ $deliveryType->description }}</a>
			</small>
		</div>
		<div class="col-md-4 col-sm-4">
            {!! Form::file('image', ['id' => 'image-' . $deliveryType->id, 'class' => 'dropify', 'data-height' => '100', 'data-default-file' => ($deliveryType->image) ? $deliveryType->getImageUrl() : '', 'data-max-file-size' => '3M', 'data-setting-id' => $deliveryType->id, 'data-delete-url' => route('admin.deliveryTypes.deleteImage'), 'data-upload-url' => route('admin.deliveryTypes.uploadImage')]) !!}
            <span class="help-block error">
                <strong class="text"></strong>
            </span>
		</div>
		<div class="col-md-2 col-sm-2">
			<div class="switchery-demo">
				{!! Form::hidden('is_active', 0) !!}
				{!! Form::checkbox('is_active', 1, $deliveryType->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-url' => route('admin.deliveryTypes.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $deliveryType->id]) !!}
			</div>
		</div>
	</div>
	@endforeach
</div>