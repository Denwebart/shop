<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<a href="{{ $item->getUrl() }}">
    @if($item->type == \App\Models\Page::TYPE_CATALOG)
        <i class="icon icon-bag-alt"></i>
    @endif
    <span>{{ $item->getTitle() }}</span>
</a>