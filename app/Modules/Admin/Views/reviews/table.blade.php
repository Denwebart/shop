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
        <th>Имя клиента</th>
        <th>Email</th>
        <th>Аватарка</th>
        <th>Статус публикации</th>
        <th>Дата публикации</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($reviews as $review)
            <tr class="@if(!$review->is_published) not-published @endif @if(!$review->updated_at) bg-muted @endif">
                <td>{{ $review->id }}</td>
                <td>{{ $review->user_name }}</td>
                <td>{{ $review->user_email }}</td>
                <td><img src="{{ $review->getUserAvatarUrl() }}" class="img-circle" width="40px" alt="{{ $review->user_name }}"></td>
                <td>
                    <span class="label @if($review->is_published) label-success @else label-danger @endif">
                        {{ \App\Models\Review::$is_published[$review->is_published] }}
                    </span>
                </td>
                <td>{{ \App\Helpers\Date::format($review->published_at) }}</td>

                <td>
                    <a href="{{ route('admin.shop_reviews.edit', ['id' => $review->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>
                        <a href="javascript:void(0)" class="button-delete" title="Удалить" data-toggle="tooltip" data-item-id="{{ $review->id }}" data-item-title="{{ $review->user_name }}">
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
                    title: "Удалить отзыв о магазине?",
                    text: 'Вы точно хотите удалить отзыв от "'+ itemTitle +'"?',
                    type: "error",
                    showCancelButton: true,
                    cancelButtonText: 'Отмена',
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    confirmButtonText: 'Удалить'
                },
                function(){
                    $.ajax({
                        url: "/admin/shop_reviews/" + itemId,
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