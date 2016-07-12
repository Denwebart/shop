<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@foreach($properties as $key => $property)
    <div class="property clearfix m-b-20" data-property-id="{{ $property->id }}">
        <div class="col-md-12 col-sm-12 col-xs-12 m-b-10 bg-muted">
            <h4 class="header-title m-t-10 m-b-10 pull-left">
                <a href="#" class="editable-text" data-value="{{ $property->title }}" data-name="title" data-type="text" data-pk="{{ $property->id }}" data-url="{{ route('admin.properties.setPropertyValue') }}">{{ $property->title }}</a>
                <small class="text-muted">(тип: {{ mb_strtolower(\App\Models\Property::$types[$property->type]) }})</small>
            </h4>
            <a href="#" class="remove-property pull-right m-t-5 m-b-5" data-property-id="{{ $property->id }}" data-item-title="{{ $property->title }}" data-count-values="{{ count($property->values) ? \App\Helpers\Str::wordValuesCount(count($property->values)) : 0 }}" data-count-products="{{ $property->productsCount ? \App\Helpers\Str::wordProductCount($property->productsCount) : 0 }}" title="Удалить характеристику" data-toggle="tooltip">
                <i class="fa fa-remove"></i>
            </a>
        </div>

        <div class="property-values-container form-horizontal form-editable m-b-20" data-property-id="{{ $property->id }}">
            @include('admin::properties.values', ['property' => $property])
        </div>

        <a href="#" class="m-r-10 pull-right show-property-value-form" data-property-id="{{ $property->id }}" data-toggle="tooltip" title="Добавить значение харакеристики &laquo;{{ $property->title }}&raquo;">
            Добавить значение
            <i class="fa fa-plus m-l-5"></i>
        </a>
        <div class="clearfix"></div>

        {!! Form::open(['url' => route('admin.properties.addValue'), 'class' => 'form-horizontal m-t-10 m-b-20 new-property-value-form', 'data-property-id' => $property->id, 'style' => "display: none"]) !!}
            <div class="input-group m-t-10">
                {!! Form::text('value', null, ['class' => 'form-control', 'id' => 'new-value-of-property-' . $property->id]) !!}
                <span class="input-group-btn">
                    <button type="button" class="add-property-value btn waves-effect waves-light btn-primary" data-property-id="{{ $property->id }}">Добавить</button>
                </span>
            </div>
            <div class="help-block error value_error"></div>
        {!! Form::close() !!}
    </div>
@endforeach