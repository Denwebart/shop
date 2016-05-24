<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(is_object($models) && count($models))
    Показано
    <span class="on-page">{{ count($models) }}</span>
    @if(count($models))
        из <span class="total">{{ $models->total() }}</span>
    @endif
@elseif(is_array($models) && $models['total'])
    Показано
    <span class="on-page">{{ count($models['data']) }}</span>
    @if(count($models['data']))
        из <span class="total">{{ $models['total'] }}</span>
    @endif
@endif