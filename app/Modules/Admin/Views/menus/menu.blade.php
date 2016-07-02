<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<h4 class="header-title m-t-0 m-b-10"><b>Меню сайта</b></h4>
<p class="text-muted font-13 m-b-15">
    {{--Правый клик мыши на пункте меню для редактирования или удаления. <br>--}}
    Зажать и перетащить пункт меню для смены порядка.
</p>

<div id="menus">
    @foreach(\App\Models\Menu::$types as $menuType => $menuTitle)
        <h5>{{ $menuTitle }}</h5>
        <div class="menu-items" data-menu-type="{{ $menuType }}">
            @include('admin::menus.items', ['items' => isset($menuItems[$menuType]) ? $menuItems[$menuType] : []])
        </div>
    @endforeach
</div>

@push('styles')
    <link href="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
    <script type="text/javascript">

        /* Change position */
        var sortableOptions = {
            cursor: 'move',
            axis: 'y',
            update: function (event, ui) {
                var positions = $(this).sortable('toArray');
                var menuType = $(ui.item).data('menu-type');
                $.ajax({
                    data: {positions: positions, menyType: menuType},
                    type: 'POST',
                    url: '{{ route('admin.menus.position') }}',
                    beforeSend: function(request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success) {
                            Command: toastr["success"](response.message);
                        } else {
                            Command: toastr["error"](response.message);
                        }
                    },
                })
            }
        };
        $(".sortable, .sortable-sublist").sortable(sortableOptions);

        /* Remame item */
        function getMenuEditableOptions() {
            return {
                url: "{{ route('admin.menus.rename') }}",
                mode: 'inline',
                prepend: false,
                clear: false,
                emptytext: 'не задано',
                ajaxOptions: {
                    dataType: 'json',
                    sourceCache: 'false',
                    type: 'PUT'
                },
                success: function(response, newValue) {
                    if(response.success) {
                        Command: toastr["success"](response.message);
                        $('.editable-menu-item[data-page-id='+ response.pageId +']')
                                .text(newValue);
                        return true;
                    } else {
                        Command: toastr["error"](response.message);
                        return response.error;
                    }
                    return false;
                }
            };
        }
        $('.editable-menu-item').editable(getMenuEditableOptions());

        /* Delete item */
        $("#menus").on('click', '.delete-item', function(e) {
            var menuType = $(this).data('menu-type'),
                menuTitle = $(this).data('menu-title'),
                itemId = $(this).data('item-id'),
                pageId = $(this).data('page-id'),
                itemTitle = $(this).data('itemTitle');

            sweetAlert(
            {
                title: "Удалить пункт меню?",
                text: 'Вы точно хотите удалить пункт меню "'+ itemTitle +'" из меню "'+ menuTitle +'"?',
                type: "error",
                showCancelButton: true,
                cancelButtonText: 'Отмена',
                confirmButtonClass: 'btn-danger waves-effect waves-light',
                confirmButtonText: 'Удалить'
            },
            function(){
                $.ajax({
                    data: {menuType: menuType, itemId: itemId},
                    type: 'POST',
                    url: '{{ route('admin.menus.delete') }}',
                    beforeSend: function(request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success) {
                            Command: toastr["success"](response.message);
                            $('.menu-items[data-menu-type='+ menuType +']').html(response.menuItemsHtml);
                            $(".sortable, .sortable-sublist").sortable(sortableOptions);
                            $('.editable-menu-item').editable(getMenuEditableOptions());
                        } else {
                            Command: toastr["error"](response.message);
                        }
                    },
                });
            });
        });

    </script>
@endpush