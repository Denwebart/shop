<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<a href="{{ route('wishlist.index') }}" class="btn dropdown-toggle btn--links--dropdown header__wishlist__button header__dropdowns__button" title="Список желаний" data-toggle="tooltip">
    <span class="icon icon-favorite"></span>
    @if(count($products))
        <span class="badge badge--menu count-wishlist-items">
            {{ count($products) }}
        </span>
    @endif
</a>