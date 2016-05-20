<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($sliders))
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Изображение</th>
            <th>Статус публикации</th>
            <th>Заголовок</th>
            <th>Текст кнопки</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td><img src="{{ $slider->getImageUrl() }}" width="300" alt="{{ $slider->image_alt }}"></td>
                    <td>
                    <span class="label @if($slider->is_published) label-success @else label-danger @endif">
                        {{ \App\Models\Slider::$is_published[$slider->is_published] }}
                    </span>
                    </td>
                    <td>{{ $slider->title }}</td>
                    <td>{{ $slider->button_text }}</td>
                    <td>
                        <a href="{{ route('admin.slider.edit', ['id' => $slider->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                            <i class="fa fa-pencil fa-lg"></i>
                        </a>
                        <a href="javascript:void(0)" class="button-delete" title="Удалить" data-toggle="tooltip" data-item-id="{{ $slider->id }}" data-item-title="{{ $slider->title }}">
                            <i class="fa fa-trash fa-lg"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="background-icon">
        <p>Слайдов нет</p>
        <a href="{{ route('admin.slider.create') }}">
            <i class="fa fa-image"></i>
            <i class="fa fa-plus lower"></i>
            <span>создать слайд</span>
        </a>
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
                    title: "Удалить слайд?",
                    text: 'Вы точно хотите удалить слайд "'+ itemTitle +'"?',
                    type: "error",
                    showCancelButton: true,
                    cancelButtonText: 'Отмена',
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    confirmButtonText: 'Удалить'
                },
                function(){
                    $.ajax({
                        url: "/admin/slider/" + itemId,
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