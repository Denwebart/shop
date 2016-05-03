<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<ol class="breadcrumb breadcrumb--wd pull-left">
    @foreach($page->getBreadcrumbItems() as $item)
        <li>
            @if($item['url'])
                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
            @else
                {{ $item['title'] }}
            @endif
        </li>
    @endforeach
</ol>