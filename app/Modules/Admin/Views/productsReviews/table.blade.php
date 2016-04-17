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
        <th>К товару</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Рейтинг</th>
        <th>Полезен</th>
        <th>Не полезен</th>
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
                    @if($productReview->parent_id)
                        <i class="fa fa-level-down" title="Комментарий к отзыву" data-toggle="tooltip"></i>
                    @else
                        <i class="fa fa-comment" title="Отзыв к товару" data-toggle="tooltip"></i>
                    @endif
                </td>
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
                <td>{{ $productReview->rating }}</td>
                <td>{{ $productReview->like }}</td>
                <td>{{ $productReview->dislike }}</td>
                <td>
                    <span class="label @if($productReview->is_published) label-success @else label-danger @endif">
                        {{ \App\Models\ProductReview::$is_published[$productReview->is_published] }}
                    </span>
                </td>
                <td>{{ \App\Helpers\Date::format($productReview->created_at) }}</td>
                <td>{{ \App\Helpers\Date::format($productReview->published_at) }}</td>
                <td>
                    @if($productReview->parent_id == 0)
                        <a href="#" title="Ответить" data-toggle="tooltip">
                            <i class="fa fa-reply"></i>
                        </a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.reviews.edit', ['id' => $productReview->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>

                    <a href="javascript:void(0)" class="button-delete" title="Удалить" data-toggle="tooltip" data-item-id="{{ $productReview->id }}" data-item-title="{{ $productReview->user ? $productReview->user->login : $productReview->user_name }}@if($productReview->product) к товару &#34;{{ $productReview->product->title }}&#34;@endif">
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