<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@foreach($property->values as $key => $propertyValue)
    <div class="property-value form-group" data-value-id="{{ $propertyValue->id }}">
        <div class="col-md-2 col-sm-2 col-xs-0"></div>
        <div class="col-md-4 col-sm-5 col-xs-5">
            <a href="#" class="editable-text" data-value="{{ $propertyValue->value }}" data-name="value" data-type="text" data-pk="{{ $propertyValue->id }}" data-url="{{ route('admin.properties.setValueValue') }}">{{ $propertyValue->value }}</a>
        </div>
        <div class="col-md-3 col-sm-2 col-xs-3 m-t-5">
            @if($property->type == \App\Models\Property::TYPE_COLOR)
                {{--доделать редактирование цвета--}}
                {{--<a href="#" class="editable-text" data-value="{{ $propertyValue->additional_value }}" data-name="additional_value" data-type="text" data-pk="{{ $propertyValue->id }}" data-url="{{ route('admin.properties.setValueValue') }}">{{ $propertyValue->additional_value }}</a>--}}
                <span class="color-icon color" style="background: {{ $propertyValue->additional_value or '#ffffff' }}"></span>
            @elseif($property->type == \App\Models\Property::TYPE_BRAND)
                {{--доделать загрузку изображений--}}
            @else
                {{--<small>--}}
                    {{--(--}}
                    {{--<a href="#" class="editable-text" data-value="{{ $propertyValue->additional_value }}" data-name="additional_value" data-type="text" data-pk="{{ $propertyValue->id }}" data-url="{{ route('admin.properties.setValueValue') }}">{{ $propertyValue->additional_value }}</a>--}}
                    {{--)--}}
                {{--</small>--}}
            @endif
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            {{ \App\Helpers\Str::wordProductCount(count($propertyValue->products)) }}
        </div>
        <div class="col-md-1 col-sm-1 col-xs-2">
            <a href="#" class="remove-property-value pull-right margin-right-5" data-value-id="{{ $propertyValue->id }}" data-property-id="{{ $property->id }}" data-value-title="{{ $propertyValue->value }}" data-property-title="{{ $property->title }}" data-count-products="{{ count($propertyValue->products) ? \App\Helpers\Str::wordProductCount(count($propertyValue->products)) : 0 }}" title="Удалить значение" data-toggle="tooltip">
                <i class="fa fa-remove"></i>
            </a>
        </div>
    </div>
@endforeach