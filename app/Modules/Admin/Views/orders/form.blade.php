<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

{!! csrf_field() !!}

<input name="backUrl" type="hidden" value="{{ URL::previous() }}">

<div class="row">
    {{--<div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-2 control-label" for="parent_id">Категория</label>--}}
            {{--<div class="col-md-10">--}}
                {{--<select name="parent_id" id="parent_id" class="form-control">--}}
                    {{--<option value="0" @if($product->parent_id == 0) selected @endif> --- </option>--}}
                    {{--@foreach(\App\Models\Page::getCategory(\App\Models\Page::TYPE_CATALOG) as $categoryId => $categoryTitle)--}}
                        {{--<option value="{{ $categoryId }}" @if($product->parent_id == $categoryId) selected @endif>--}}
                            {{--{{ $categoryTitle }}--}}
                        {{--</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-2 control-label" for="alias">Алиас</label>--}}
            {{--<div class="col-md-10">--}}
                {{--<input name="alias" id="alias" type="text" class="form-control" value="{{ $product->alias }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-2 control-label" for="vendor_code">Артикул</label>--}}
            {{--<div class="col-md-10">--}}
                {{--<input name="vendor_code" id="vendor_code" type="text" class="form-control" value="{{ $product->menu_title }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-2 control-label" for="title">Заголовок</label>--}}
            {{--<div class="col-md-10">--}}
                {{--<input name="title" id="title" type="text" class="form-control" value="{{ $product->title }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-2 control-label" for="title">Цена</label>--}}
            {{--<div class="col-md-10">--}}
                {{--<input name="title" id="title" type="text" class="form-control" value="{{ $product->price }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<div class="col-sm-6 col-md-6">--}}
                {{--<label class="control-label m-b-5" for="image">Изображение для страницы</label>--}}
                {{--<input name="image" id="image" type="file" class="dropify" data-default-file="{{ $product->getImagePath() }}" data-max-file-size="1M" />--}}
                {{--<span class="help-block">--}}
                    {{--<small>--}}
                        {{--Изображение отображается перед текстом страницы--}}
                        {{--и при выводе страниц блогом.--}}
                    {{--</small>--}}
                {{--</span>--}}
            {{--</div>--}}
            {{--<div class="col-sm-6 col-md-6">--}}
                {{--<label class="control-label m-b-5" for="image_alt">Альт для изображения</label>--}}
                {{--<textarea name="image_alt" id="image_alt" class="form-control" rows="8">--}}
                    {{--{{ $product->image_alt }}--}}
                {{--</textarea>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div><!-- end col -->--}}

    {{--<div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-2 control-label" for="meta_title">Мета-тег Title</label>--}}
            {{--<div class="col-md-10">--}}
                {{--<textarea name="meta_title" id="meta_title" class="form-control" rows="2">{{ $product->meta_title }}</textarea>--}}
                {{--<span class="help-block">--}}
                    {{--<small>Самый важный SEO-тег. Рекомендуемая длина - 65 символов.</small>--}}
                {{--</span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-2 control-label" for="meta_desc">Мета-тег Description</label>--}}
            {{--<div class="col-md-10">--}}
                {{--<textarea name="meta_desc" id="meta_desc" class="form-control" rows="3">{{ $product->meta_desc }}</textarea>--}}
                {{--<span class="help-block">--}}
                    {{--<small>Второй по важности SEO-тег. Рекомендуемая длина - 160 символов.</small>--}}
                {{--</span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-2 control-label" for="meta_key">Мета-тег Keywords</label>--}}
            {{--<div class="col-md-10">--}}
                {{--<textarea name="meta_key" id="meta_key" class="form-control" rows="3">{{ $product->meta_key }}</textarea>--}}
                {{--<span class="help-block">--}}
                    {{--<small>Необязательный SEO-тег. Существительные в единственном числе через запятую.</small>--}}
                {{--</span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<div class="switchery-demo m-b-5">--}}
                {{--<div class="col-md-2">--}}
                {{--</div>--}}
                {{--<div class="col-md-4">--}}
                    {{--<input name="is_published" id="is_published" type="checkbox" @if($product->is_published) checked @endif data-plugin="switchery" data-color="#3bafda" data-size="small"/>--}}
                    {{--<label class="control-label m-l-5" for="is_published">--}}
                        {{--Опубликован--}}
                    {{--</label>--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                    {{--@if(!$product->published_at)--}}
                        {{--(сохраните, чтоб опубликовать)--}}
                    {{--@else--}}
                        {{--{{ \App\Helpers\Date::format($product->published_at, true) }}--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div><!-- end col -->--}}

    {{--<div class="col-md-7 col-sm-12 col-xs-12">--}}
        {{--<div class="form-group">--}}
            {{--<div class="col-md-12">--}}
                {{--<label class="control-label m-b-5" for="content">Описание товара</label>--}}
                {{--<textarea name="content" id="content" class="form-control editor" rows="10">{{ $product->content }}</textarea>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-md-5 col-sm-12 col-xs-12">--}}
        {{--<div class="form-group">--}}
            {{--<div class="col-md-12">--}}
                {{--<label class="control-label m-b-5" for="introtext">Краткое описание товара</label>--}}
                {{--<textarea name="introtext" id="introtext" class="form-control editor" rows="10">{{ $product->introtext }}</textarea>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

</div><!-- end row -->

@push('styles')
    <link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugins/summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/fileuploads/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/summernote/lang/summernote-ru-RU.js') }}"></script>

    <script type="text/javascript">

        // Image Uploader
        $('.dropify').dropify({
            messages: {
                'default': 'Кликните или перетащите файл.',
                'replace': 'Кликните или перетащите файл для замены.',
                'remove': 'Удалить',
                'error': 'Ошибка, что-то пошло не так.'
            },
            error: {
                'fileSize': 'Размер файла слишком большой (максимум 1Мб).'
            }
        });

        // WYSIWYG
        $(document).ready(function() {
            $('.editor').summernote({
                lang: 'ru-RU',
                height: 300,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false                  // set focus to editable area after initializing summernote
            });
        });

        // Buttons
        $(document).on('click', '.button-save-exit', function() {
            $("#main-form").submit();
        });
        $(document).on('click', '.button-save', function() {
            $("#main-form").submit();
        });
        $(document).on('click', '.button-cancel', function() {
            $("#main-form").submit();
        });

    </script>
@endpush