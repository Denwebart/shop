<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($product->propertySize))
    <label>Размер:</label>
    <ul class="options-swatch options-swatch--size options-swatch--lg">
        @foreach($product->propertySize as $size)
            @php($sizePropertyTitle = $size->property ? $size->property->title : null)
            <li class="add-to-cart__size tooltip-link @if(Request::get($sizePropertyTitle) == $size->value || (isset($options['size']) && $options['size'] == $size->value) || count($product->propertySize) == 1) active @endif" title="{{ $size->value }} @if($size->additional_value) ({{ $size->additional_value }}) @endif" data-value="{{ $size->value }}">
                <span class="swatch-label">{{ $size->value }}</span>
            </li>
        @endforeach
    </ul>
    <span class="help-block error add-to-cart__size___error"></span>
    {!! Form::hidden('add-to-cart__size__input', Request::get($sizePropertyTitle, isset($options['size']) ? $options['size'] : '')) !!}
    <div class="divider divider--xs"></div>
@endif