<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

{!! csrf_field() !!}

{!! Form::hidden('backUrl', $backUrl) !!}
{!! Form::hidden('returnBack', 1, ['id' => 'returnBack']) !!}

<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group">
            <div class="col-sm-6 col-md-6 @if($errors->has('image')) has-error @endif">
                {!! Form::label('image', 'Изображение', ['class' => 'control-label m-b-5']) !!}
                {!! Form::file('image', ['id' => 'image', 'class' => 'dropify', 'data-default-file' => $slider->getImageUrl(), 'data-max-file-size' => '10M', 'data-show-remove' => false]) !!}
                <span class="help-block @if($errors->has('image')) hidden @endif">
                    <small>
                       Изображение слайда. Минимальная ширина - <strong>750px</strong>.
                    </small>
                </span>
                @if ($errors->has('image'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-sm-6 col-md-6 @if($errors->has('image_alt')) has-error @endif">
                {!! Form::label('image_alt', 'Альт для изображения', ['class' => 'control-label m-b-5']) !!}
                {!! Form::textarea('image_alt', $slider->image_alt, ['id' => 'image_alt', 'class' => 'form-control', 'rows' => 8]) !!}

                @if ($errors->has('image_alt'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('image_alt') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group @if($errors->has('is_published')) has-error @endif">
                <div class="switchery-demo m-b-5 m-l-10">
                    <div class="col-md-4">
                        {!! Form::hidden('is_published', 0) !!}
                        {!! Form::checkbox('is_published', 1, $slider->is_published, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                        {!! Form::label('is_published', 'Опубликован', ['class' => 'control-label m-l-5']) !!}
                    </div>
                    <div class="col-md-8">
                        @if ($errors->has('is_published'))
                            <span class="help-block error">
                            <strong>{{ $errors->first('is_published') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group @if($errors->has('button_text')) has-error @endif">
                {!! Form::label('button_text', 'Текст кнопки', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('button_text', $slider->button_text, ['id' => 'button_text', 'class' => 'form-control', 'rows' => 3]) !!}

                    <span class="help-block @if($errors->has('button_text')) hidden @endif">
                    <small>Если текст не заполнен - на кнопке будет будет написано "Подробнее".</small>
                </span>
                    @if ($errors->has('button_text'))
                        <span class="help-block error">
                        <strong>{{ $errors->first('button_text') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group @if($errors->has('button_link')) has-error @endif">
                {!! Form::label('button_link', 'Ссылка для кнопки', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('button_link', $slider->button_link, ['id' => 'button_link', 'class' => 'form-control']) !!}

                    <span class="help-block @if($errors->has('button_link')) hidden @endif">
                    <small>Если ссылка для кнопки не выставлена - кнопка не будет отображена.<br>Пример: http://shop.dev/katalog</small>
                </span>
                    @if ($errors->has('button_link'))
                        <span class="help-block error">
                        <strong>{{ $errors->first('button_link') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('title')) has-error @endif">
            {!! Form::label('title', 'Заголовок', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::textarea('title', $slider->title, ['id' => 'title', 'class' => 'form-control', 'rows' => 2]) !!}

                <span class="help-block @if($errors->has('title')) hidden @endif">
                    <small>Первая строка на слайде.</small>
                </span>
                @if ($errors->has('title'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('text_1')) has-error @endif">
            {!! Form::label('text_1', 'Текст 1', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::textarea('text_1', $slider->text_1, ['id' => 'text_1', 'class' => 'form-control', 'rows' => 3]) !!}

                <span class="help-block @if($errors->has('text_1')) hidden @endif">
                    <small>Вторая строка на слайде.</small>
                </span>
                @if ($errors->has('text_1'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('text_1') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('text_2')) has-error @endif">
            {!! Form::label('text_2', 'Текст 2', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::textarea('text_2', $slider->text_2, ['id' => 'text_2', 'class' => 'form-control', 'rows' => 3]) !!}

                <span class="help-block @if($errors->has('text_2')) hidden @endif">
                    <small>Третья строка на слайде.</small>
                </span>
                @if ($errors->has('text_2'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('text_2') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('text_align')) has-error @endif">
            <div class="switchery-demo m-b-5 m-l-10">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    {!! Form::label('text_align', 'Выравнивание текста', ['class' => 'control-label m-l-5']) !!}

                    @foreach(App\Models\Slider::$textAlign as $alignKey => $alignValue)
                        <div class="clearfix"></div>
                        {!! $alignValue !!}
                        {!! Form::radio('text_align', $alignKey, ($slider->text_align == $alignKey), ['class' => 'form-control']) !!}
                    @endforeach
                </div>
                <div class="col-md-6">
                    @if ($errors->has('text_align'))
                        <span class="help-block error">
                            <strong>{{ $errors->first('text_align') }}</strong>
                        </span>
                    @endif
                </div>
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

    </script>
@endpush