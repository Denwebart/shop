<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($products))
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
                        <img src="{{ $product->getImageUrl() }}" alt="{{ $product->image_alt }}" width="100" class="pull-left">
                        @if(count($product->images))
                            <div class="product-images pull-left">
                                @foreach($product->images as $image)
                                    <img src="{{ $image->getImageUrl() }}" alt="{{ $image->image_alt }}" width="20">
                                @endforeach
                            </div>
                        @endif
                    </td>
                    <td>{{ $product->vendor_code }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ \App\Helpers\Str::priceFormat($product->getPrice()) }}</td>
                    <td>{{ $product->category->getTitle() }}</td>
                    <td>
                        <span class="label @if($product->is_published) label-success @else label-danger @endif">
                            {{ \App\Models\Product::$is_published[$product->is_published] }}
                        </span>
                    </td>
                    <td>{{ \App\Helpers\Date::format($product->published_at) }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                            <i class="fa fa-pencil fa-lg"></i>
                        </a>
                        <a href="javascript:void(0)" class="button-delete" title="Удалить" data-toggle="tooltip" data-item-id="{{ $product->id }}" data-item-title="{{ $product->title }}">
                            <i class="fa fa-trash fa-lg"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="background-icon">
        <p class="m-b-20">Товаров нет</p>
        <a href="{{ route('admin.products.create') }}">
            <i class="fa fa-shopping-bag"></i>
            <i class="fa fa-plus lower"></i>
            <span class="m-t-20">добавить товар</span>
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
                    title: "Удалить товар?",
                    text: 'Вы точно хотите удалить товар "'+ itemTitle +'"?',
                    type: "error",
                    showCancelButton: true,
                    cancelButtonText: 'Отмена',
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    confirmButtonText: 'Удалить'
                },
                function(){
                    $.ajax({
                        url: "/admin/products/" + itemId,
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