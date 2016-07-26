<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="col-md-12 bg-muted">
    <label class="m-t-10 m-b-10">{{ $property->title }}</label>
    <a href="#" class="m-t-10 m-r-15 pull-right open-product-property-value-form" data-property-id="{{ $property->id }}" data-toggle="tooltip" title="Добавить значение харакеристики &laquo;{{ $property->title }}&raquo;">
        Добавить значение
        <i class="fa fa-plus m-l-5"></i>
    </a>
    <div class="new-product-property-value-form m-b-20" data-property-id="{{ $property->id }}" style="display: none">
        {!! Form::open(['url' => route('admin.productProperties.add'), 'class' => 'form-horizontal m-t-10']) !!}
        <p class="text-muted font-13 m-b-15">
            Начните вводить значение характеристики &laquo;{{ $property->title }}&raquo;, которое необходимо добавить для товара.
        </p>
        <div class="input-group m-t-10">
            <input type="text" id="new-product-value-of-property-{{ $property->id }}" data-property-id="{{ $property->id }}" name="new-product-value-of-property-{{ $property->id }}" class="form-control" placeholder="">
            <span class="input-group-btn">
                <button type="button" class="add-product-property-value btn waves-effect waves-light btn-primary" data-property-id="{{ $property->id }}">Добавить</button>
            </span>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="col-md-12">
    @foreach($property->values as $value)
        <div class="property-value form-group" data-item-id="{{ $value->id }}" data-property-id="{{ $property->id }}">
            <div class="col-md-2 col-sm-2 col-xs-0"></div>
            <div class="col-md-4 col-sm-5 col-xs-5">
                {{ $value->value }}
            </div>
            <div class="col-md-3 col-sm-2 col-xs-3 m-t-5">
                @if($property->type == \App\Models\Property::TYPE_COLOR)
                    <span class="color-icon color" style="background: {{ $value->additional_value or '#ffffff' }}"></span>
                @elseif($property->type == \App\Models\Property::TYPE_BRAND)
                    @if($value->additional_value)
                        <img src="{{ $value->getImageUrl() }}" alt="{{ $value->value }}">
                    @endif
                @else
                    @if($value->additional_value)
                        <small>({{ $value->additional_value }})</small>
                    @endif
                @endif
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
            </div>
            <div class="col-md-1 col-sm-1 col-xs-2">
                <a href="#" class="delete-value pull-right margin-right-5" data-item-id="{{ $value->property_value_id }}" data-product-id="{{ $product->id }}" data-property-id="{{ $property->id }}" data-item-title="{{ $value->value }}" data-property-title="{{ $property->title }}" title="Удалить значение" data-toggle="tooltip">
                    <i class="fa fa-remove"></i>
                </a>
            </div>
        </div>

        {{--<li class="list-group-item clearfix" id="{{ $value->property_value_id }}" data-item-id="{{ $value->property_value_id }}" data-property-id="{{ $property->id }}">--}}
            {{--<span class="title value pull-left">--}}
                {{--{{ $value->value }}--}}
            {{--</span>--}}
            {{--<a href="#" class="delete-value pull-right margin-right-5" data-item-id="{{ $value->property_value_id }}" data-product-id="{{ $product->id }}" data-property-id="{{ $property->id }}" data-item-title="{{ $value->value }}" data-property-title="{{ $property->title }}" title="Удалить значение" data-toggle="tooltip">--}}
                {{--<i class="fa fa-remove"></i>--}}
            {{--</a>--}}
        {{--</li>--}}
    @endforeach
</div>