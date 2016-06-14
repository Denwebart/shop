<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="property form-group" data-property-id="{{ $property->id }}">
    <label class="col-md-3 col-sm-3 control-label" title="{{ $property->title }}" data-toggle="tooltip">
        {{ $property->title }}
    </label>
    <div class="col-md-7 col-sm-7">
        @foreach($property->values as $value)
            <a href="#" class="editable-text" data-value="{{ $value->value }}" data-name="value" data-type="text" data-pk="{{ $value->id }}" data-url="{{ route('admin.productProperties.setValue') }}">
                {{ $value->value }}
            </a>
        @endforeach
    </div>
    <div class="col-md-2 col-sm-2">
        <a href="javascript:void(0)" class="remove-property pull-right" data-id="{{ $property->id }}" data-title="{{ $property->title }}" title="Удалить" data-toggle="tooltip">
            <i class="fa fa-remove fa-lg m-t-10"></i>
        </a>
    </div>
</div>