<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="work-with-us-item form-group" data-work-with-us-id="{{ $item->id }}">
    <div class="col-md-6 col-sm-6 control-label">
        <a href="#" class="editable-text" data-value="{{ $item->title }}" data-name="title" data-type="text" data-pk="{{ $item->id }}" data-url="{{ route('admin.workWithUs.setValue') }}">{{ $item->title }}</a>
    </div>
    <div class="col-md-4 col-sm-4 m-t-5">
        {!! Form::file('image', ['id' => 'image-' . $item->id, 'class' => 'dropify-ajax', 'data-height' => '100', 'data-default-file' => ($item->image) ? $item->getImageUrl() : '', 'data-max-file-size' => '3M', 'data-setting-id' => $item->id, 'data-delete-url' => route('admin.workWithUs.deleteImage'), 'data-upload-url' => route('admin.workWithUs.uploadImage')]) !!}
        <span class="help-block error">
        <strong class="text"></strong>
    </span>
    </div>
    <div class="col-md-2 col-sm-2">
        <div class="switchery-demo pull-left">
            {!! Form::hidden('is_published', 0) !!}
            {!! Form::checkbox('is_published', 1, $item->is_published, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-url' => route('admin.workWithUs.setIsActive'), 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $item->id]) !!}
        </div>
        <a href="javascript:void(0)" class="remove-work-with-us pull-right" data-id="{{ $item->id }}" data-title="{{ $item->title }}" title="Удалить" data-toggle="tooltip">
            <i class="fa fa-remove fa-lg m-t-10"></i>
        </a>
    </div>
</div>