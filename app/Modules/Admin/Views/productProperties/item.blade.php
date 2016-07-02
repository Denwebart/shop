<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="col-md-2">
    <label>{{ $property->title }}</label>
</div>
<div class="col-md-10">
    <ul class="list-group user-list">
        @foreach($property->values as $value)
            @if($property->type != \App\Models\Property::TYPE_DEFAULT)
                <li class="list-group-item clearfix" id="{{ $value->id }}" data-item-id="{{ $value->id }}" data-property-id="{{ $property->id }}">
                    <span class="value pull-left">
                        {{ $value->value }}
                    </span>
                    <a href="#" class="delete-value pull-right margin-right-5" data-item-id="{{ $value->id }}" data-product-id="{{ $product->id }}" data-property-id="{{ $property->id }}" data-item-title="{{ $value->value }}" data-property-title="{{ $property->title }}" title="Удалить значение" data-toggle="tooltip">
                        <i class="fa fa-remove"></i>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>