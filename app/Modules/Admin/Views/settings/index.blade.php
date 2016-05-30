<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Настройки сайта';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-8">
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
        <div class="col-sm-4">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Общая информация</b></h4>

                <p class="text-muted font-13 m-b-15"></p>

                <div class="form-horizontal form-editable">
                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 control-label">
                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->title }}
                            @if($settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->description)
                                <small>{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->description }}</small>
                            @endif
                        </label>
                        <div class="col-md-7 col-sm-7">
                            <a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->value }}" data-type="textarea" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->value }}</a>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="switchery-demo">
                                {!! Form::hidden('is_active', 0) !!}
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['siteTitle']->id]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 control-label">
                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->title }}
                            @if($settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->description)
                                <small>{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->description }}</small>
                            @endif
                        </label>
                        <div class="col-md-7 col-sm-7">
                            <a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->value }}" data-type="textarea" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->value }}</a>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="switchery-demo">
                                {!! Form::hidden('is_active', 0) !!}
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['copyright']->id]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 control-label">
                            {{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->title }}
                            @if($settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->description)
                                <small>{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->description }}</small>
                            @endif
                        </label>
                        <div class="col-md-7 col-sm-7">
                            <a href="#" class="editable-text" data-value="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->value }}" data-type="textarea" data-pk="{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->id }}">{{ $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->value }}</a>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="switchery-demo">
                                {!! Form::hidden('is_active', 0) !!}
                                {!! Form::checkbox('is_active', 1, $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $settings[\App\Models\Setting::CATEGORY_SITE]['footerText']->id]) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::open(['files' => true]) !!}
                        @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['logo'] as $key => $setting)
                            <div class="form-group settings image-container @if($key != 'main') dark @endif" data-image-setting-id="{{ $setting->id }}">
                                <label class="col-md-3 col-sm-3 control-label">
                                    {{ $setting->title }}
                                    @if($setting->description)
                                        <small>{{ $setting->description }}</small>
                                    @endif
                                </label>
                                <div class="col-md-7 col-sm-7">
                                    {!! Form::file('logo.' . $key, ['id' => 'logo.' . $key, 'class' => 'dropify', 'data-height' => '100', 'data-default-file' => ($setting->value) ? asset('images/' . $setting->value) : '', 'data-max-file-size' => '3M', 'data-setting-id' => $setting->id]) !!}
                                    <span class="help-block error">
                                        <strong class="text"></strong>
                                    </span>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <div class="switchery-demo">
                                        {!! Form::hidden('is_active', 0) !!}
                                        {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Социальные сети</b></h4>

                <p class="text-muted font-13 m-b-15">
                    Ссылки на группу или страницу в социальных сетях.
                </p>

                <div class="form-horizontal form-editable">
                    @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['socialButtons'] as $key => $setting)
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label" title="{{ $setting->description }}" data-toggle="tooltip">
                                <i class="fa fa-{{ $key }}"></i>
                                {{ $setting->title }}
                            </label>
                            <div class="col-md-7 col-sm-7">
                                <a href="#" class="editable-text" data-value="{{ $setting->value }}" data-type="text" data-pk="{{ $setting->id }}">
                                    {{ $setting->value }}
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="switchery-demo">
                                    {!! Form::hidden('is_active', 0) !!}
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Контактная информация</b></h4>

                <p class="text-muted font-13 m-b-15">
                    Контактная информация, которая будет отображена на сайте.
                </p>

                <div class="form-horizontal form-editable">
                    @foreach($settings[\App\Models\Setting::CATEGORY_SITE]['contactInfo'] as $key => $setting)
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label">
                                <i class="fa fa-{{ \App\Models\Setting::$contactInfoIcons[$key] }}"></i>
                                {{ $setting->title }}
                                @if($setting->description)
                                    <small>{{ $setting->description }}</small>
                                @endif
                            </label>
                            <div class="col-md-7 col-sm-7">
                                <a href="#" class="editable-text" data-value="{{ $setting->value }}" @if($setting->type == \App\Models\Setting::TYPE_TEXT) data-type="textarea" @else data-type="text" @endif data-pk="{{ $setting->id }}">{{ $setting->value }}</a>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="switchery-demo">
                                    {!! Form::hidden('is_active', 0) !!}
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <h5 class="header-title m-t-20 m-b-10"><b>Координаты на карте</b></h5>
                <p class="text-muted font-13 m-b-15">
                    Карта будет отображена на странице с контактами только в том случае,
                    если заполнены и включены обе настройки.
                </p>

                <div class="form-horizontal form-editable">
                    @foreach($settings[\App\Models\Setting::CATEGORY_CONTACT_PAGE]['map'] as $key => $setting)
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label">
                                {{ $setting->title }}
                            </label>
                            <div class="col-md-7 col-sm-7">
                                <a href="#" class="editable-text" data-value="{{ $setting->value }}" data-type="text" data-pk="{{ $setting->id }}">{{ $setting->value }}</a>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="switchery-demo">
                                    {!! Form::hidden('is_active', 0) !!}
                                    {!! Form::checkbox('is_active', 1, $setting->is_active, ['id' => 'is_active', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small', 'data-id' => $setting->id]) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">

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
            </div>

            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-10"><b>Слайдер</b></h4>

                <a href="{{ route('admin.slider.index') }}">
                    <span>Редактировать</span>
                </a>
            </div>
        </div><!-- end col -->
    </div>

@endsection

@push('styles')
    <link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- XEditable Plugin -->
    <link type="text/css" href="{{ asset('backend/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet">

    <!-- Treeview css -->
    <link href="{{ asset('backend/plugins/jstree/style.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/fileuploads/js/dropify.min.js') }}"></script>

    <script type="text/javascript">
        // Image Uploader
        var drEvent = $('.dropify').dropify({
            messages: {
                'default': 'Кликните или перетащите файл.',
                'replace': 'Кликните или перетащите файл для замены.',
                'remove': 'Удалить',
                'error': 'Ошибка.'
            },
            error: {
                'fileSize': 'Размер файла слишком большой (максимум 3Мб).'
            }
        });

        drEvent.on('dropify.fileReady', function(event, element) {
            var settingId = $(this).data('settingId');
            var data = new FormData();
            data.append("id", settingId);
            data.append("value", $(this)[0].files[0]);
            $.ajax({
                url: "{{ route('admin.settings.uploadImage') }}",
                dataType: "json",
                processData: false,
                contentType: false,
                type: "POST",
                data: data,
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    var $imageContainer = $('[data-image-setting-id="' + settingId + '"]');
                    $imageContainer.removeClass('has-error');
                    $imageContainer.find('.error .text').text('');

                    if(response.success){
                        Command: toastr["success"](response.message);
                    } else {
                        Command: toastr["error"](response.message);

                        $imageContainer.addClass('has-error');
                        $imageContainer.find('.error .text').text(response.error);
                    }
                }
            });
        });

        drEvent.on('dropify.beforeClear', function(event, element) {
            var settingId = $(this).data('settingId');
            $.ajax({
                url: "{{ route('admin.settings.deleteImage') }}",
                dataType: "text json",
                type: "POST",
                data: {id: settingId},
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success){
                        Command: toastr["success"](response.message);

                        var $imageContainer = $('[data-image-setting-id="' + settingId + '"]');
                        $imageContainer.removeClass('has-error');
                        $imageContainer.find('.error .text').text('');
                    } else {
                        Command: toastr["error"](response.message);
                    }
                }
            });
        });
    </script>

    <!-- XEditable Plugin -->
    <script type="text/javascript" src="{{ asset('backend/plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>

    <script type="text/javascript">
        //modify buttons style
        $.fn.editableform.buttons =
            '<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="zmdi zmdi-check"></i></button>' +
            '<button type="button" class="btn editable-cancel btn-sm waves-effect"><i class="zmdi zmdi-close"></i></button>';

        $.fn.editableform.defaults.params = function (params) {
            params._token = $("meta[name='csrf-token']").attr('content');
            return params;
        };

        // Text
        $('.editable-text').editable({
            url: "{{ route('admin.settings.setValue') }}",
            mode: 'inline',
            prepend: false,
            emptytext: 'не задано',
            ajaxOptions: {
                dataType: 'json',
                sourceCache: 'false',
                type: 'PUT'
            },
            success: function(response, newValue) {
                if(response.success) {
                    Command: toastr["success"](response.message);
                    return true;
                } else {
                    Command: toastr["error"](response.message);
                    return response.error;
                }
                return false;
            }
        });

        // Change active ststus
        $('[data-plugin=switchery]').on('change', function () {
            if($(this).is(':checked')) {
                var isActive = 1;
            } else {
                var isActive = 0;
            }
            $.ajax({
                url: "{{ route('admin.settings.setIsActive') }}",
                dataType: "text json",
                type: "POST",
                data: {id: $(this).data('id'), 'is_active': isActive},
                beforeSend: function(request) {
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