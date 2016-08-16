<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="row">
    @foreach($users as $user)
        <div class="col-md-4 col-sm-6">
            @include('admin::users.user')
        </div> <!-- end col -->
    @endforeach
</div>

@push('styles')
    <link href="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
    <script type="text/javascript">
        !function ($) {
            "use strict";

            $('#table-container').on('click', '.button-delete', function (e) {
                var itemId = $(this).data('itemId'),
                    itemTitle = $(this).data('itemTitle'),
                    hasActivities = $(this).data('hasActivities');
                var text = '';
                if(hasActivities) {
                    text = text + '\n Пользователь будет отмечен удаленным, активность пользователя возможно будет восстановить.';
                } else {
                    text = text + '\n Пользователь будет безвозвратно удален с сайта.'
                }
                sweetAlert(
                {
                    title: "Удалить пользователя?",
                    text: 'Вы точно хотите удалить пользователя '+ itemTitle +'?' + text,
                    type: "error",
                    showCancelButton: true,
                    cancelButtonText: 'Отмена',
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    confirmButtonText: 'Удалить'
                },
                function(){
                    $.ajax({
                        url: "/admin/users/" + itemId,
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
            });

            $('#table-container').on('click', '.button-undelete', function (e) {
                var itemId = $(this).data('itemId');
                var itemTitle = $(this).data('itemTitle');
                sweetAlert(
                {
                    title: "Восстановить пользователя?",
                    text: 'Вы точно хотите восстановить активность пользователя '+ itemTitle +'?',
                    type: "success",
                    showCancelButton: true,
                    cancelButtonText: 'Отмена',
                    confirmButtonClass: 'btn-success waves-effect waves-light',
                    confirmButtonText: 'Восстановить'
                },
                function(){
                    $.ajax({
                        url: "{{ route('admin.users.undelete') }}",
                        dataType: "text json",
                        type: "post",
                        data: {userId: itemId},
                        beforeSend: function (request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                        },
                        success: function (response) {
                            if (response.success) {
                                Command: toastr["success"](response.message);
                                $('#table-container').html(response.itemsTable);
                            } else {
                                Command: toastr["danger"](response.message);
                            }
                        }
                    });
                });
            });

        }(window.jQuery);
    </script>
@endpush