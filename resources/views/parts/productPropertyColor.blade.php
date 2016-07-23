<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($product->propertyColor))
    <label>Цвет:</label>
    <ul class="options-swatch options-swatch--color options-swatch--lg">
        @foreach($product->propertyColor as $color)
            <li class="add-to-cart__color tooltip-link @if(Request::get($color->property_title) == $color->value || (isset($options['color']) && $options['color'] == $color->value) || count($product->propertyColor) == 1) active @endif" title="{{ $color->value }}" data-value="{{ $color->value }}">
                <span class="swatch-label color-icon color" style="background: {{ $color->additional_value or '#ffffff' }}"></span>
            </li>
        @endforeach
        {!! Form::hidden('add-to-cart__color__input', Request::get($color->property_title, isset($options['color']) ? $options['color'] : '')) !!}
        <span class="help-block error add-to-cart__color___error"></span>
    </ul>
    <div class="divider divider--sm"></div>
@endif