<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

{!! csrf_field() !!}

<input name="backUrl" type="hidden" value="{{ $backUrl }}">
<input name="returnBack" type="hidden" value="1" id="returnBack">

<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('parent_id')) has-error @endif">
            <label class="col-md-2 control-label" for="parent_id">Категория</label>
            <div class="col-md-10">
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="0" @if($page->parent_id == 0) selected @endif> --- </option>
                    @foreach(\App\Models\Page::getCategory() as $categoryId => $categoryTitle)
                        <option value="{{ $categoryId }}" @if($page->parent_id == $categoryId || old('parent_id') == $categoryId) selected @endif>
                            {{ $categoryTitle }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('parent_id'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('parent_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('alias')) has-error @endif">
            <label class="col-md-2 control-label" for="alias">Алиас</label>
            <div class="col-md-10">
                <input name="alias" id="alias" type="text" class="form-control" value="{{ $page->alias or old('alias') }}">
                @if ($errors->has('alias'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('alias') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('title')) has-error @endif">
            <label class="col-md-2 control-label" for="title">Заголовок</label>
            <div class="col-md-10">
                <input name="title" id="title" type="text" class="form-control" value="{{ $page->title or old('title') }}">
                @if ($errors->has('title'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('menu_title')) has-error @endif">
            <label class="col-md-2 control-label" for="menu_title">Заголовок меню</label>
            <div class="col-md-10">
                <input name="menu_title" id="menu_title" type="text" class="form-control" value="{{ $page->menu_title or old('menu_title') }}">
                @if ($errors->has('menu_title'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('menu_title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('is_container')) has-error @endif">
            <div class="switchery-demo m-b-5">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <input type="hidden" name="is_container" value="0">
                    <input name="is_container" value="1" id="is_container" type="checkbox" @if($page->is_container || old('is_container')) checked @endif data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                    <label class="control-label m-l-5" for="is_container">
                        Категория
                    </label>
                </div>
                <div class="col-md-6">
                    <span class="help-block m-t-0">
                        <small>Будет ли содержать вложенные страницы?</small>
                    </span>
                </div>
                @if ($errors->has('is_container'))
                    <span class="help-block error">
                        {{ old('is_container') }}
                        <strong>{{ $errors->first('is_container') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6 col-md-6 @if($errors->has('image')) has-error @endif">
                <label class="control-label m-b-5" for="image">Изображение для страницы</label>
                {{ old('image') }}
                <input name="image" id="image" type="file" class="dropify" data-default-file="{{ $page->getImagePath() }}" data-max-file-size="3M" />
                <span class="help-block @if($errors->has('image')) hidden @endif">
                    <small>
                        Изображение отображается перед текстом страницы
                        и при выводе страниц блогом.
                    </small>
                </span>
                @if ($errors->has('image'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-sm-6 col-md-6 @if($errors->has('image_alt')) has-error @endif">
                <label class="control-label m-b-5" for="image_alt">Альт для изображения</label>
                <textarea name="image_alt" id="image_alt" class="form-control" rows="8">{{ $page->image_alt or old('image_alt') }}</textarea>
                @if ($errors->has('image_alt'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('image_alt') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('meta_title')) has-error @endif">
            <label class="col-md-2 control-label" for="meta_title">Мета-тег Title</label>
            <div class="col-md-10">
                <textarea name="meta_title" id="meta_title" class="form-control" rows="2">{{ $page->meta_title or old('meta_title') }}</textarea>
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
            <label class="col-md-2 control-label" for="meta_desc">Мета-тег Description</label>
            <div class="col-md-10">
                <textarea name="meta_desc" id="meta_desc" class="form-control" rows="3">{{ $page->meta_desc or old('meta_desc') }}</textarea>
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
            <label class="col-md-2 control-label" for="meta_key">Мета-тег Keywords</label>
            <div class="col-md-10">
                <textarea name="meta_key" id="meta_key" class="form-control" rows="3">{{ $page->meta_key or old('meta_key') }}</textarea>
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
            <div class="switchery-demo m-b-5">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <input type="hidden" name="is_published" value="0">
                    <input name="is_published" value="1" id="is_published" type="checkbox" @if($page->is_published || old('is_published')) checked @endif data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                    <label class="control-label m-l-5" for="is_published">
                        Опубликована
                    </label>
                </div>
                <div class="col-md-6">
                    @if(!$page->published_at)
                        (сохраните, чтоб опубликовать)
                    @else
                        {{ \App\Helpers\Date::format($page->published_at, true) }}
                    @endif

                    @if ($errors->has('is_published'))
                        <span class="help-block error">
                            <strong>{{ $errors->first('is_published') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<label class="control-label col-md-2">Дата/время публикации</label>--}}
            {{--<div class="col-md-5">--}}
                {{--<div class="input-group">--}}
                    {{--<input name="published_date" type="text" class="form-control" placeholder="день.месяц.год" id="datepicker" value="">--}}
                    {{--<span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>--}}
                {{--</div><!-- input-group -->--}}
            {{--</div>--}}
            {{--<div class="col-md-5">--}}
                {{--<div class="input-group">--}}
                    {{--<div class="bootstrap-timepicker">--}}
                        {{--<input name="published_time" id="timepicker" type="text" class="form-control" value="">--}}
                    {{--</div>--}}
                    {{--<span class="input-group-addon bg-primary b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>--}}
                {{--</div><!-- input-group -->--}}
            {{--</div>--}}
        {{--</div>--}}
    </div><!-- end col -->

    <div class="col-md-7 col-sm-12 col-xs-12">
        <div class="form-group @if($errors->has('content')) has-error @endif">
            <div class="col-md-12">
                <label class="control-label m-b-5" for="content">Текст страницы</label>
                <textarea name="content" id="content" class="form-control editor" rows="10">{{ $page->content or old('content') }}</textarea>
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
                <label class="control-label m-b-5" for="introtext">Краткое описание страницы</label>
                <textarea name="introtext" id="introtext" class="form-control editor" rows="10">{{ $page->introtext or old('introtext') }}</textarea>
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
    {{--<link href="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">--}}
    {{--<link href="{{ asset('backend/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">--}}
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/fileuploads/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/summernote/lang/summernote-ru-RU.js') }}"></script>
    {{--<script src="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>--}}
    {{--<script src="{{ asset('backend/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>--}}

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
            $("#returnBack").val('0');
            $("#main-form").submit();
        });

//        // Time Picker
//        jQuery('#timepicker').timepicker({
//            showMeridian : false
//        });
//
//        // Date Picker
//        $.fn.datepicker.dates['ru'] = {
//            days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
//            daysShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Суб"],
//            daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
//            months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
//            monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
//            today: "Сегодня",
//            clear: "Очистить",
//            format: "dd.mm.yyyy",
//            weekStart: 1
//        };
//        jQuery('#datepicker').datepicker({
//            autoclose: true,
//            todayHighlight: true,
//            language: 'ru'
//        });

    </script>
@endpush