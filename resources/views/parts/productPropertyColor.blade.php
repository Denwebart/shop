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
            @php($colorPropertyTitle = $color->property ? $color->property->title : null)
            <li class="add-to-cart__color tooltip-link @if(Request::get($colorPropertyTitle) == $color->value || (isset($options['color']) && $options['color'] == $color->value) || count($product->propertyColor) == 1) active @endif" title="{{ $color->value }}" data-value="{{ $color->value }}">
                <span class="swatch-label color-icon color" style="background: {{ $color->additional_value or '#ffffff' }}"></span>
            </li>
        @endforeach
    </ul>
    <span class="help-block error add-to-cart__color___error"></span>
    {!! Form::hidden('add-to-cart__color__input', Request::get($colorPropertyTitle, isset($options['color']) ? $options['color'] : '')) !!}
    <div class="divider divider--sm"></div>
@endif