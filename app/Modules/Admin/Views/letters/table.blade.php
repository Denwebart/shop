<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
@if(count($letters))
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Тема</th>
            <th>Текст сообщения</th>
            <th>Дата получения</th>
            <th>Дата прочтения</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($letters as $letter)
                <tr @if(is_null($letter->updated_at)) class="bg-muted" @endif>
                    <td>{{ $letter->id }}</td>
                    <td>{{ $letter->name }}</td>
                    <td>{{ $letter->email }}</td>
                    <td>{{ \App\Helpers\Str::limit($letter->subject, 30) }}</td>
                    <td>{{ \App\Helpers\Str::limit($letter->message, 30) }}</td>
                    <td>{{ \App\Helpers\Date::format($letter->created_at) }}</td>
                    <td>{{ \App\Helpers\Date::format($letter->updated_at) }}</td>
                    <td>
                        <a href="{{ route('admin.letters.show', ['id' => $letter->id]) }}" title="Прочесть" data-toggle="tooltip" class="m-r-15">
                            <i class="fa fa-eye fa-lg"></i>
                        </a>
                        @if(Auth::user()->isAdmin())
                            <a href="javascript:void(0)" class="button-delete" title="Удалить" data-toggle="tooltip" data-item-id="{{ $letter->id }}" data-item-title="{{ $letter->name }} ({{ $letter->email }})">
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
        <p>Писем нет</p>
        <i class="fa fa-envelope"></i>
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
                var itemTitle = $(this).data('itemTitle');
                sweetAlert(
                        {
                            title: "Удалить письмо?",
                            text: 'Вы точно хотите удалить письмо от '+ itemTitle +' ?',
                            type: "error",
                            showCancelButton: true,
                            cancelButtonText: 'Отмена',
                            confirmButtonClass: 'btn-danger waves-effect waves-light',
                            confirmButtonText: 'Удалить'
                        },
                        function(){
                            $.ajax({
                                url: "/admin/letters/" + itemId,
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