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
        <th>Артикул</th>
        <th>Заголовок</th>
        <th>Цена</th>
        <th>Категория</th>
        <th>Статус публикации</th>
        <th>Дата публикации</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr @if(!$product->is_published) class="not-published" @endif>
                <td>{{ $product->id }}</td>
                <td>
                    <img src="{{ $product->getImagePath() }}" alt="{{ $product->image_alt }}" width="100">
                </td>
                <td>{{ $product->vendor_code }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->category->getTitle() }}</td>
                <td>
                    <span class="label @if($product->is_published) label-success @else label-danger @endif">
                        {{ \App\Models\Product::$is_published[$product->is_published] }}
                    </span>
                </td>
                <td>{{ date('j.m.Y в H:i', strtotime($product->published_at)) }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
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