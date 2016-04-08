<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="col-md-2 control-label" for="parent_id">Категория</label>
            <div class="col-md-10">
                <select name="parent_id" id="parent_id" class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="alias">Алиас</label>
            <div class="col-md-10">
                <input name="alias" id="alias" type="text" class="form-control" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="title">Заголовок</label>
            <div class="col-md-10">
                <input name="title" id="title" type="text" class="form-control" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="menu_title">Заголовок меню</label>
            <div class="col-md-10">
                <input name="menu_title" id="menu_title" type="text" class="form-control" value="">
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-6">
        <div class="form-group">
            <label class="col-md-2 control-label" for="meta_title">Мета-тег Title</label>
            <div class="col-md-10">
                <textarea name="meta_title" id="meta_title" class="form-control" rows="2"></textarea>
                <span class="help-block">
                    <small>Самый важный SEO-тег. Рекомендуемая длина - 65 символов.</small>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="meta_desc">Мета-тег Description</label>
            <div class="col-md-10">
                <textarea name="meta_desc" id="meta_desc" class="form-control" rows="3"></textarea>
                <span class="help-block">
                    <small>Второй по важности SEO-тег. Рекомендуемая длина - 160 символов.</small>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="meta_key">Мета-тег Keywords</label>
            <div class="col-md-10">
                <textarea name="meta_key" id="meta_key" class="form-control" rows="3"></textarea>
                <span class="help-block">
                    <small>Необязательный SEO-тег. Существительные в единственном числе через запятую.</small>
                </span>
            </div>
        </div>
        <div class="form-group">
            <div class="switchery-demo m-b-5">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <input name="is_published" id="is_published" type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                    <label class="control-label m-l-5" for="is_published">
                        Опубликована
                    </label>
                </div>
                <div class="col-md-4">
                    еще не опубликована
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

</div><!-- end row -->

@push('styles')
    <link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>

        // Time Picker
        jQuery('#timepicker').timepicker({
            showMeridian : false
        });

        // Date Picker
        $.fn.datepicker.dates['ru'] = {
            days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
            daysShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Суб"],
            daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
            today: "Сегодня",
            clear: "Очистить",
            format: "dd.mm.yyyy",
            weekStart: 1
        };
        jQuery('#datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'ru'
        });

    </script>
@endpush