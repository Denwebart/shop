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
                <td>
                    @if($productReview->product)
                        {{ $productReview->product->title }}
                    @endif
                </td>
                <td>
                    @if($productReview->user)
                        <a href="{{ route('admin.users.show', ['id' => $productReview->user->id]) }}">
                            {{ $productReview->user->login }}
                        </a>
                    @else
                        {{ $productReview->user_name }}
                    @endif
                </td>
                <td>
                    @if($productReview->user)
                        {{ $productReview->user->email }}
                    @else
                        {{ $productReview->user_email }}
                    @endif
                </td>
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
                    <a href="#" class="button-delete" title="Удалить" data-toggle="tooltip" data-item-id="{{ $productReview->id }}" data-item-title="{{ $productReview->user ? $productReview->user->login : $productReview->user_name }}@if($productReview->product) к товару &#34;{{ $productReview->product->title }}&#34;@endif">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@push('styles')
    <link href="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
    <script type="text/javascript">
        !function ($) {
            "use strict";

            $('#table-container').on('click', '.button-delete', function (e) {
                var itemId = $(this).data('itemId');
                var itemTitle = $(this).data('itemTitle');
                sweetAlert(
                {
                    title: "Удалить отзыв?",
                    text: 'Вы точно хотите удалить отзыв от '+ itemTitle +'?',
                    type: "error",
                    showCancelButton: true,
                    cancelButtonText: 'Отмена',
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    confirmButtonText: 'Удалить'
                },
                function(){
                    $.ajax({
                        url: "/admin/reviews/" + itemId,
                        dataType: "text json",
                        type: "DELETE",
                        data: {},
                        beforeSend: function (request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function (response) {
                            if (response.success) {
                                Command: toastr["success"](response.message);

                                $('.count-container').html(response.itemsCount);
                                $('.pagination-container').html(response.itemsPagination);
                                $('#table-container').html(response.itemsTable);
                            } else {
                                Command: toastr["warning"](response.message);
                            }
                        }
                    });
                });
            })

        }(window.jQuery);
    </script>
@endpush