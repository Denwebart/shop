<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($calls))
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Статус</th>
            <th>Комментарий</th>
            <th>Заказан</th>
            <th>Обработан</th>
            <th>Менеджер</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($calls as $call)
                <tr @if(!$call->status) class="bg-muted" @endif>
                    <td>{{ $call->id }}</td>
                    <td>{{ $call->name }}</td>
                    <td>{{ $call->getPhone() }}</td>
                    <td>
                        @if($call->status)
                            <span class="label @if($call->status == \App\Models\RequestedCall::STATUS_PHONED) label-success @else label-danger @endif">
                                {{ \App\Models\RequestedCall::$statuses[$call->status] }}
                            </span>
                        @endif
                    </td>
                    <td>{{ \App\Helpers\Str::limit($call->comment, 50) }}</td>
                    <td>{{ \App\Helpers\Date::getRelative($call->created_at) }}</td>
                    <td>{{ \App\Helpers\Date::getRelative($call->answered_at) }}</td>
                    <td>
                        @if($call->user)
                            <a href="{{ route('admin.users.show', ['id' => $call->user->id]) }}">
                                <img src="{{ $call->user->getAvatarUrl() }}" class="img-circle" width="40px" alt="{{ $call->user->login }}" title="Ответил {{ $call->user->login }}" data-toggle="tooltip" data-placement="right">
                                <span class="m-l-5">{{ $call->user->login }}</span>
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.calls.edit', ['id' => $call->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                            <i class="fa fa-pencil fa-lg"></i>
                        </a>
                        @if(Auth::user()->isAdmin())
                            <a href="javascript:void(0)" class="button-delete" title="Удалить" data-toggle="tooltip" data-item-id="{{ $call->id }}" data-item-title="{{ $call->login }}">
                                <i class="fa fa-trash fa-lg"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="background-icon">
        <p>Заказанных звонков нет</p>
        <i class="fa fa-phone"></i>
    </div>
@endif

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
            sweetAlert(
                    {
                        title: "Удалить звонок?",
                        text: 'Вы точно хотите удалить звонок ?',
                        type: "error",
                        showCancelButton: true,
                        cancelButtonText: 'Отмена',
                        confirmButtonClass: 'btn-danger waves-effect waves-light',
                        confirmButtonText: 'Удалить'
                    },
                    function(){
                        $.ajax({
                            url: "/admin/calls/" + itemId,
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
                                    if(!response.itemsCount) {
                                        $('.white-bg').removeClass('card-box');
                                    }
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