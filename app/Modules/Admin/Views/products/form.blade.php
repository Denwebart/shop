<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

{!! csrf_field() !!}

{!! Form::hidden('backUrl', $backUrl) !!}
{!! Form::hidden('returnBack', 1, ['id' => 'returnBack']) !!}
{!! Form::hidden('deleteImage', 0, ['id' => 'deleteImage']) !!}

<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('category_id')) has-error @endif">
            {!! Form::label('category_id', 'Категория', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::select('category_id', \App\Models\Page::getCategory(\App\Models\Page::TYPE_CATALOG), $product->category_id, ['id' => 'category_id', 'class' => 'form-control']) !!}
                @if($errors->has('category_id'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('alias')) has-error @endif">
            {!! Form::label('alias', 'Алиас', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::text('alias', $product->alias, ['id' => 'alias', 'class' => 'form-control']) !!}

                @if ($errors->has('alias'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('alias') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('vendor_code')) has-error @endif">
            {!! Form::label('vendor_code', 'Артикул', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::text('vendor_code', $product->vendor_code, ['id' => 'vendor_code', 'class' => 'form-control']) !!}

                @if ($errors->has('vendor_code'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('vendor_code') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('title')) has-error @endif">
            {!! Form::label('title', 'Заголовок', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::text('title', $product->title, ['id' => 'title', 'class' => 'form-control']) !!}

                @if ($errors->has('title'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group @if($errors->has('price')) has-error @endif">
                {!! Form::label('price', 'Цена', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        {!! Form::text('price', $product->price, ['id' => 'price', 'class' => 'form-control']) !!}
                        <span class="input-group-addon">
                            {{ Config::get('checkout.defaultCurrency.text') }}
                        </span>
                    </div>
                <span class="help-block @if($errors->has('price')) hidden @endif">
                    <small>
                        Цена товара. Например: 1000 или 1000.00
                    </small>
                </span>
                    @if ($errors->has('price'))
                        <span class="help-block error">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group @if($errors->has('price')) has-error @endif">
                {!! Form::label('new_price', 'Новая цена', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        {!! Form::text('new_price', null, ['id' => 'new_price', 'class' => 'form-control']) !!}
                        <span class="input-group-addon">
                            {{ Config::get('checkout.defaultCurrency.text') }}
                        </span>
                    </div>
                <span class="help-block @if($errors->has('new_price')) hidden @endif">
                    <small>
                        Акционная цена
                    </small>
                </span>
                    @if ($errors->has('new_price'))
                        <span class="help-block error">
                        <strong>{{ $errors->first('new_price') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <div class="col-sm-5 col-md-5 @if($errors->has('image')) has-error @endif">
                {!! Form::label('image', 'Изображение для товара', ['class' => 'control-label m-b-5']) !!}
                {!! Form::file('image', ['id' => 'image', 'class' => 'dropify', 'data-default-file' => $product->getImageUrl(null, false), 'data-max-file-size' => '3M']) !!}
                <span class="help-block @if($errors->has('image')) hidden @endif">
                    <small>
                        Рекомендуемые размеры:
                        <br>
                        ширина – 1200px, высота – 1510px.
                    </small>
                </span>
                @if ($errors->has('image'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-sm-7 col-md-7 @if($errors->has('image_alt')) has-error @endif">
                {!! Form::label('image_alt', 'Альт для изображения', ['class' => 'control-label m-b-5']) !!}
                {!! Form::textarea('image_alt', $product->image_alt, ['id' => 'image_alt', 'class' => 'form-control', 'rows' => 8]) !!}

                @if ($errors->has('image_alt'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('image_alt') }}</strong>
                    </span>
                @endif
            </div>
            @if($product->id)
                <div class="col-md-12">
                    <div class="task-detail">
                        <div class="attached-files">
                            <div class="files-list product-images">
                                @include('admin::products.images')
                            </div>
                            <span class="help-block">
                                <small>Дополнительные изображения для товара.</small>
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{--<div class="form-group product-images">--}}
            {{--<div class="col-md-12">--}}
                {{--{!! Form::label('images[0]', 'Дополнительные изображения для товара', ['class' => 'control-label m-b-5']) !!}--}}
            {{--</div>--}}
            {{--<div class="col-xs-3 col-sm-2 col-md-2 @if($errors->has('images[0]')) has-error @endif">--}}
                {{--{!! Form::file('images[0]', ['id' => 'images[0]', 'class' => 'dropify', 'data-default-file' => $product->getImageUrl(), 'data-max-file-size' => '3M']) !!}--}}
                {{--@if ($errors->has('images[0]'))--}}
                    {{--<span class="help-block error">--}}
                        {{--<strong>{{ $errors->first('images[0]') }}</strong>--}}
                    {{--</span>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}
    </div><!-- end col -->

    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('meta_title')) has-error @endif">
            {!! Form::label('meta_title', 'Мета-тег Title', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::textarea('meta_title', $product->meta_title, ['id' => 'meta_title', 'class' => 'form-control', 'rows' => 2]) !!}

                <span class="help-block @if($errors->has('meta_title')) hidden @endif">
                    <small>Самый важный SEO-тег. Рекомендуемая длина - 65 символов.</small>
                </span>
                @if ($errors->has('meta_title'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('meta_title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('meta_desc')) has-error @endif">
            {!! Form::label('meta_desc', 'Мета-тег Description', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::textarea('meta_desc', $product->meta_desc, ['id' => 'meta_desc', 'class' => 'form-control', 'rows' => 3]) !!}

                <span class="help-block @if($errors->has('meta_desc')) hidden @endif">
                    <small>Второй по важности SEO-тег. Рекомендуемая длина - 160 символов.</small>
                </span>
                @if ($errors->has('meta_desc'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('meta_desc') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('meta_key')) has-error @endif">
            {!! Form::label('meta_key', 'Мета-тег Keywords', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::textarea('meta_key', $product->meta_key, ['id' => 'meta_key', 'class' => 'form-control', 'rows' => 3]) !!}

                <span class="help-block @if($errors->has('meta_key')) hidden @endif">
                    <small>Необязательный SEO-тег. Существительные в единственном числе через запятую.</small>
                </span>
                @if ($errors->has('meta_key'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('meta_key') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('is_published')) has-error @endif">
            <div class="col-md-2">
            </div>
            <div class="col-md-4 switchery-demo">
                {!! Form::hidden('is_published', 0) !!}
                {!! Form::checkbox('is_published', 1, $product->is_published, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                {!! Form::label('is_published', 'Опубликован', ['class' => 'control-label m-l-5']) !!}
            </div>
            <div class="col-md-6">
                @if(!$product->published_at)
                    (сохраните, чтоб опубликовать)
                @else
                    {{ \App\Helpers\Date::format($product->published_at) }}
                @endif

                @if ($errors->has('is_published'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('is_published') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-md-7 col-sm-12 col-xs-12">
        <div class="form-group @if($errors->has('content')) has-error @endif">
            <div class="col-md-12">
                {!! Form::label('content', 'Описание товара', ['class' => 'control-label m-b-5']) !!}
                <span class="help-block">
                    <small>
                        Отображается во вкладке "Описание" на странице товара.
                    </small>
                </span>

                {!! Form::textarea('content', $product->content, ['id' => 'content', 'class' => 'form-control editor', 'rows' => 10]) !!}

                @if ($errors->has('content'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-5 col-sm-12 col-xs-12">
        <div class="form-group @if($errors->has('introtext')) has-error @endif">
            <div class="col-md-12">
                {!! Form::label('introtext', 'Краткое описание товара', ['class' => 'control-label m-b-5']) !!}
                <span class="help-block">
                    <small>
                        Отображается под ценой на странице товара, выводится в каталоге.
                    </small>
                </span>

                {!! Form::textarea('introtext', $product->introtext, ['id' => 'introtext', 'class' => 'form-control editor', 'rows' => 10]) !!}

                @if ($errors->has('introtext'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('introtext') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

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
            $("#returnBack").val('1');
            $("#main-form").submit();
        });
        $(document).on('click', '.button-save', function() {
            $("#returnBack").val('0');
            $("#main-form").submit();
        });
        
        
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

        drEvent.on('dropify.afterClear', function(event, element){
            $('#deleteImage').val(1);
        });

//        $('.dropify-more').dropify({
//            messages: {
//                'default': '+',
//                'replace': '',
//                'remove': 'x',
//                'error': 'Ошибка!'
//            },
//            error: {
//                'fileSize': 'Размер файла слишком большой (максимум 3Мб).'
//            }
//        });

        // Image Uploader
        $(document).on('click', '.add-new-product-image', function (e) {
            $('.new-product-image').removeClass('hidden');
        });

        var dropifyMoreOptions = {
            messages: {
                'default': '+',
                'replace': '',
                'remove': 'x',
                'error': 'Ошибка!'
            },
            error: {
                'fileSize': 'Размер файла слишком большой (максимум 3Мб).'
            }
        };

        function ajaxUploadImage(event, element, dropifyElement)
        {
            var productId = "{{ $product->id }}";
            var imageId = dropifyElement.data('imageId');
            var url = "{{ route('admin.products.uploadImage') }}";
            var data = new FormData();
            data.append("image_id", imageId);
            data.append("product_id", productId);
            data.append("image", dropifyElement[0].files[0]);
            $.ajax({
                url: url,
                dataType: "json",
                processData: false,
                contentType: false,
                type: "POST",
                data: data,
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success){
                        Command: toastr["success"](response.message);
                        $('.product-images').html(response.productImages);

                        var dropifyAjax = $('.dropify-more').dropify(dropifyMoreOptions);

                        dropifyAjax.on('dropify.fileReady', function(event, element) {
                            ajaxUploadImage(event, element, $(this));
                        });

                        dropifyAjax.on('dropify.beforeClear', function(event, element) {
                            ajaxDeleteImage(event, element, $(this));
                        });
                    } else {
                        Command: toastr["error"](response.message);
                    }
                }
            });
        }

        function ajaxDeleteImage(event, element, dropifyElement)
        {
            var productId = "{{ $product->id }}";
            var imageId = dropifyElement.data('imageId');
            var url = "{{ route('admin.products.deleteImage') }}";
            $.ajax({
                url: url,
                dataType: "text json",
                type: "POST",
                data: {product_id: productId, image_id: imageId},
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success){
                        Command: toastr["success"](response.message);
                        $('.product-images').html(response.productImages);

                        var dropifyAjax = $('.dropify-more').dropify(dropifyMoreOptions);

                        dropifyAjax.on('dropify.fileReady', function(event, element) {
                            ajaxUploadImage(event, element, $(this));
                        });

                        dropifyAjax.on('dropify.beforeClear', function(event, element) {
                            ajaxDeleteImage(event, element, $(this));
                        });
                    } else {
                        Command: toastr["error"](response.message);
                    }
                }
            });
        }

        var dropifyAjax = $('.dropify-more').dropify(dropifyMoreOptions);

        dropifyAjax.on('dropify.fileReady', function(event, element) {
            ajaxUploadImage(event, element, $(this));
        });

        dropifyAjax.on('dropify.beforeClear', function(event, element) {
            ajaxDeleteImage(event, element, $(this));
        });
    </script>
@endpush