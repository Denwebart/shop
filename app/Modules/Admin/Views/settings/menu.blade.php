<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<h4 class="header-title m-t-0 m-b-10"><b>Меню сайта</b></h4>
<p class="text-muted font-13 m-b-15">
    Правый клик мыши на пункте меню для редактирования или удаления. <br>
    Зажать и перетащить пункт меню для смены порядка.
</p>

@foreach(\App\Models\Menu::$types as $menuType => $menuTitle)
    <h5>{{ $menuTitle }}</h5>
    <div class="menu-tree" data-menu-type="{{ $menuType }}">
        <ul>
            @if(isset($menuItems[$menuType]))
                @foreach($menuItems[$menuType] as $item)
                    <li data-jstree='{"type":"{{ $item->page->type == \App\Models\Page::TYPE_PAGE && $item->page->is_container ? 'category' : ($item->page->type == \App\Models\Page::TYPE_CATALOG ? 'catalog' : 'file') }}", "opened":false}' data-page-id="{{ $item->page->id }}" data-menu-id="{{ $item->id }}">{{ $item->page->getTitle() }}
                        @if(count($item->children))
                            <ul>
                                @foreach($item->children as $child)
                                    <li data-jstree='{"icon":"{{ $child->page->type == \App\Models\Page::TYPE_PAGE && $child->page->is_container ? 'fa fa-folder' : ($child->page->type == \App\Models\Page::TYPE_CATALOG ? 'fa fa-shopping-bag' : 'fa fa-file-o') }}", "opened":false, "children:false"}' data-page-id="{{ $child->page->id }}" data-menu-id="{{ $item->id }}">{{ $child->page->getTitle() }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
@endforeach

@push('styles')
    <link href="{{ asset('backend/plugins/jstree/style.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <!-- Tree view js -->
    <script src="{{ asset('backend/plugins/jstree/jstree.min.js') }}"></script>
    <script type="text/javascript">
        // Ajax
        /*
         function getMenuItems(type) {
             return $.ajax({
             url: "{{ route('admin.menus.getJsonMenuItems') }}",
             dataType: "json",
             type: "POST",
             data: {type: type},
             async: true,
             beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
             }
             });
         }
         */
        $('.menu-tree').jstree({
            'core' : {
                'check_callback' : true,
                'themes' : {
                    'responsive': false,
                    "variant" : "large"
                }
            },
            "types" : {
                'default' : {
                    'icon' : 'fa fa-file-o'
                },
                'page' : {
                    'icon' : 'fa fa-file-o'
                },
                'category' : {
                    'icon' : 'fa fa-folder'
                },
                'catalog' : {
                    'icon' : 'fa fa-shopping-bag'
                }
            },
            "contextmenu":{
                "items": function () {
                    return {
//                        "Create": {
//                            "label": "Создать пункт меню",
//                            "action": function (data) {
//                                var ref = $.jstree.reference(data.reference);
//                                sel = ref.get_selected();
//                                if(!sel.length) { return false; }
//                                sel = sel[0];
//                                sel = ref.create_node(sel, {"type":"file"});
//                                if(sel) {
//                                    ref.edit(sel);
//                                }
//                            },
//                            "icon" : 'fa fa-plus'
//                        },
                        "Rename": {
                            "label": "Переименовать пункт меню",
                            "action": function (data) {
                                var inst = $.jstree.reference(data.reference);
                                obj = inst.get_node(data.reference);
                                inst.edit(obj);
                            },
                            "icon" : 'fa fa-pencil'
                        },
                        "Delete": {
                            "label": "Удалить пункт меню",
                            "action": function (data) {
                                var ref = $.jstree.reference(data.reference),
                                        sel = ref.get_selected();
                                if(!sel.length) { return false; }
                                ref.delete_node(sel);
                            },
                            "icon" : 'fa fa-trash'
                        },
                        "Edit": {
                            "label": "Редактировать страницу",
                            "action": function (data) {
                                var inst = $.jstree.reference(data.reference),
                                        obj = inst.get_node(data.reference),
                                        pageId = obj['data']['pageId'],
                                        url = "/admin/pages/" + pageId + "/edit";
                                return window.open(url);
                            },
                            "icon" : 'fa fa-share'
                        }
                    };
                }
            },
            "plugins" : [ "contextmenu", "dnd", "search", "state", "types", "wholerow" ]
        })
        // Rename menu item
        .bind('rename_node.jstree', function(e, data) {
            var $tree = $(this);
            var pageId = data.node['data']['pageId'];
            var newMenuTitle = data.text;
            var oldMenuTitle = data.old;
            $.ajax({
                url: "{{ route('admin.menus.rename') }}",
                dataType: "json",
                type: "POST",
                data: {'menu_title': newMenuTitle, 'page_id': pageId},
                async: true,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success){
                        Command: toastr["success"](response.message);
                    } else {
                        $tree.jstree('set_text', data.node, oldMenuTitle);
                        Command: toastr["error"](response.message);
                    }
                }
            });
        })
        // Delete menu item
        .bind('delete_node.jstree', function(e, data) {
            var $tree = $(this);
            var menuId = data.node['data']['menuId'];
            $.ajax({
                url: "{{ route('admin.menus.delete') }}",
                dataType: "json",
                type: "POST",
                data: {'id': menuId},
                async: true,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success){
                        Command: toastr["success"](response.message);
                    } else {
                        Command: toastr["error"](response.message);
                    }
                }
            });
        });
    </script>
@endpush