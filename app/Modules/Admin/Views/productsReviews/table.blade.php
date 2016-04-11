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
        <th>К товару</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Текст отзыва</th>
        <th>Статус публикации</th>
        <th>Оставлен</th>
        <th>Дата публикации</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($productsReviews as $productReview)
            <tr @if(!$productReview->is_published) class="not-published" @endif>
                <td>{{ $productReview->id }}</td>
                <td>{{ $productReview->product_id }}</td>
                <td>{{ $productReview->user_name }}</td>
                <td>{{ $productReview->user_email }}</td>
                <td>{{ \App\Helpers\Str::limit($productReview->text, 30) }}</td>
                <td>
                <span class="label @if($productReview->is_published) label-success @else label-danger @endif">
                    {{ \App\Models\Page::$is_published[$productReview->is_published] }}
                </span>
                </td>
                <td>{{ \App\Helpers\Date::format($productReview->created_at) }}</td>
                <td>{{ \App\Helpers\Date::format($productReview->published_at) }}</td>
                <td>
                    <a href="{{ route('admin.pages.edit', ['id' => $productReview->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
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