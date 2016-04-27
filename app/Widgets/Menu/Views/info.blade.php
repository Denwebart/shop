<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($menuItems))
    <h5 class="title text-uppercase">Информация</h5>
    <div class="v-links-list">
        <ul>
            @foreach($menuItems as $item)
                <li @if(\Request::is($item->page->getUrl()) || \Request::url() == url($item->page->alias)) class="active" @endif>
                    <a href="{{ $item->page->getUrl() }}">
                        {{ $item->page->getTitle() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif