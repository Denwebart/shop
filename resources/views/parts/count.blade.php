<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($models))
    Показано
    <span class="on-page">{{ count($models) }}</span>
    @if(count($models))
        из <span class="total">{{ $models->total() }}</span>
    @endif
@endif