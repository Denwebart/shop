<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@for($i = 1; $i <= 5; $i++)
    @if($rating >= $i)
        <span class="icon icon-star"></span>
    @else
        <span class="icon icon-star empty-star"></span>
    @endif
@endfor