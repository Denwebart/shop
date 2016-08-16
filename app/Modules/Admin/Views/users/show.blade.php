<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Просмотр информации о пользователе ' . $user->login;
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-8">
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
                <li>{{ $user->login }}</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            @include('admin::users.user')
        </div> <!-- end col -->

        <div class="col-md-8">
            <h3 class="m-t-0">Статистика:</h3>
            Обработанных заказов: {{ count($user->orders) }} <br>
            Обработанных звонков: {{ count($user->requestedCalls) }} <br>
            Комментариев: {{ count($user->comments) }} <br>
            Созданных страниц: {{ count($user->pages) }} <br>
            Созданных товаров: {{ count($user->products) }} <br>
        </div>
    </div>
    <!-- end row -->
@endsection

@push('styles')
    <link href="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
    <script type="text/javascript">
        !function ($) {
            "use strict";

            $(document).on('click', '.button-delete', function (e) {
                var itemId = $(this).data('itemId');
                var itemTitle = $(this).data('itemTitle');
                sweetAlert(
                {
                    title: "Удалить пользователя?",
                    text: 'Вы точно хотите удалить пользователя '+ itemTitle +'?',
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
                                $('.item-user[data-user-id='+ itemId +']').addClass('opacity-70');
                                $('.item-user').find('.button-delete').attr('class', 'button-undelete').text('Восстановить');
                                $('.item-user').find('.status').attr('class', 'status label label-danger').text('Удален')
                            } else {
                                Command: toastr["warning"](response.message);
                            }
                        }
                    });
                });
            });

            $(document).on('click', '.button-undelete', function (e) {
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
                                $('.item-user[data-user-id='+ itemId +']').removeClass('opacity-70');
                                $('.item-user').find('.button-undelete').attr('class', 'button-delete').text('Удалить');
                                $('.item-user').find('.status').attr('class', 'status label label-success').text('Активен')
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