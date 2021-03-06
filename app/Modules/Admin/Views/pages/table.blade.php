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
        <th>Тип</th>
        <th>Заголовок</th>
        <th>Заголовок меню</th>
        <th>Алиас</th>
        <th>Родительская категория</th>
        <th>Статус публикации</th>
        <th>Дата публикации</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($pages as $page)
            <tr @if(!$page->is_published) class="not-published" @endif>
                <td>{{ $page->id }}</td>
                <td>
                    @if($page->type == \App\Models\Page::TYPE_PAGE && $page->is_container)
                        <i class="fa fa-folder" title="Категория" data-toggle="tooltip"></i>
                    @elseif($page->type == \App\Models\Page::TYPE_CATALOG)
                        <i class="fa fa-shopping-bag" title="Каталог товаров" data-toggle="tooltip"></i>
                    @else
                        <i class="fa fa-file-o" title="Страница" data-toggle="tooltip"></i>
                    @endif
                </td>
                <td>{{ $page->getTitle() }}</td>
                <td>{{ $page->menu_title }}</td>
                <td>{{ $page->alias }}</td>
                <td>
                    @if($page->parent)
                        {{ $page->parent->getTitle() }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    <span class="label @if($page->is_published) label-success @else label-danger @endif">
                        {{ \App\Models\Page::$is_published[$page->is_published] }}
                    </span>
                </td>
                <td>{{ \App\Helpers\Date::format($page->published_at) }}</td>
                <td>
                    <a href="{{ route('admin.pages.edit', ['id' => $page->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>
                    @if($page->canBeDeleted())
                        <a href="javascript:void(0)" class="button-delete" title="Удалить" data-toggle="tooltip" data-item-id="{{ $page->id }}" data-item-title="{{ $page->getTitle() }}" data-count-children="{{ count($page->children) }}" data-count-products="{{ count($page->products) }}" data-count-menus="{{ count($page->menus) }}">
                            <i class="fa fa-trash fa-lg"></i>
                        </a>
                    @endif
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
                var itemId = $(this).data('itemId'),
                    itemTitle = $(this).data('itemTitle'),
                    countProducts = $(this).data('countProducts'),
                    countChildren = $(this).data('countChildren'),
                    countMenus = $(this).data('countMenus');

                var text = '';
                if(countMenus) {
                    text = text + '\n Страница будет удалена из меню.';
                }
                if(countProducts) {
                    text = text + '\n Все продукты в этом каталоге (' + countProducts + ' шт.) будут удалены.';
                }
                if(countChildren) {
                    text = text + '\n Все вложенные страницы (' + countChildren + ' шт.) будут удалены.';
                }

                sweetAlert(
                {
                    title: "Удалить страницу?",
                    text: 'Вы точно хотите удалить страницу "'+ itemTitle +'"?' + text,
                    type: "error",
                    showCancelButton: true,
                    cancelButtonText: 'Отмена',
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    confirmButtonText: 'Удалить'
                },
                function(){
                    $.ajax({
                        url: "/admin/pages/" + itemId,
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