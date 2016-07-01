<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<ul class="sortable todo">
    @foreach($items as $item)
        <li id="{{ $item->id }}" data-item-id="{{ $item->id }}" data-page-id="{{ $item->page->id }}" data-menu-type="{{ $menuType }}">
            <span class="title pull-left">
                {{ $item->page->getTitle() }}
            </span>
            <a href="#" class="delete-item pull-right margin-right-5" data-item-id="{{ $item->id }}" data-page-id="{{ $item->page->id }}" data-menu-type="{{ $menuType }}" data-item-title="{{ $item->page->getTitle() }}" data-menu-title="{{ \App\Models\Menu::$types[$menuType] }}" title="Удалить пункт меню &laquo;{{ $item->page->getTitle() }}&raquo;" data-toggle="tooltip">
                <i class="fa fa-remove"></i>
            </a>
            <div class="clearfix"></div>
            @if(count($item->children))
                <ul class="sortable-sublist sublist margin-top-10">
                    @foreach($item->children as $itemChild)
                        <li id="{{ $itemChild->id }}" data-item-id="{{ $itemChild->id }}" data-page-id="{{ $itemChild->page->id }}" data-menu-type="{{ $menuType }}">
                            <span class="title pull-left">
                                {{ $itemChild->page->getTitle() }}
                            </span>
                            <a href="#" class="delete-item pull-right margin-right-5" data-item-id="{{ $itemChild->id }}" data-page-id="{{ $itemChild->page->id }}" data-menu-type="{{ $menuType }}" data-item-title="{{ $itemChild->page->getTitle() }}" data-menu-title="{{ \App\Models\Menu::$types[$menuType] }}" title="Удалить пункт меню &laquo;{{ $itemChild->page->getTitle() }}&raquo;" data-toggle="tooltip">
                                <i class="fa fa-remove"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>