<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th></th>
        <th>Заголовок</th>
        <th>Заголовок меню</th>
        <th>Алиас</th>
        <th>Статус публикации</th>
        <th>Дата публикации</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($pages as $page)
            <tr @if(!$page->is_published) class="not-published" @endif>
                <td>{{ $page->id }}</td>
                <td>
                    @if($page->is_container)
                        <i class="fa fa-folder"></i>
                    @else
                        <i class="fa fa-file-o"></i>
                    @endif
                </td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->menu_title }}</td>
                <td>{{ $page->alias }}</td>
                <td>
                <span class="label @if($page->is_published) label-success @else label-danger @endif">
                    {{ \App\Models\Page::$is_published[$page->is_published] }}
                </span>
                </td>
                <td>{{ date('j.m.Y в H:i', strtotime($page->published_at)) }}</td>
                <td>
                    <a href="{{ route('admin.pages.edit', ['id' => $page->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>
                    <a href="#" title="Удалить" data-toggle="tooltip">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>