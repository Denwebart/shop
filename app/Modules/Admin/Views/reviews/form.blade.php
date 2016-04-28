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
        
        <div class="form-group @if($errors->has('user_name')) has-error @endif">
            {!! Form::label('user_name', 'Имя клиента', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::text('user_name', $review->user_name, ['id' => 'user_name', 'class' => 'form-control']) !!}
                @if ($errors->has('user_name'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('user_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('user_email')) has-error @endif">
            {!! Form::label('user_email', 'Email', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::text('user_email', $review->user_email, ['id' => 'user_email', 'class' => 'form-control']) !!}

                @if ($errors->has('user_email'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('user_email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6 col-md-6 @if($errors->has('user_avatar')) has-error @endif">
                {!! Form::label('user_avatar', 'Фото клиента', ['class' => 'control-label m-b-5']) !!}
                {!! Form::file('user_avatar', ['id' => 'user_avatar', 'class' => 'dropify', 'data-default-file' => $review->getUserAvatarUrl(false), 'data-max-file-size' => '3M']) !!}
                <span class="help-block @if($errors->has('user_avatar')) hidden @endif">
                    <small>
                        Фотография клиента до 3 мегабайт.
                    </small>
                </span>
                @if ($errors->has('user_avatar'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('user_avatar') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-6 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('text')) has-error @endif">
            {!! Form::label('text', 'Текст отзыва', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::textarea('text', $review->text, ['id' => 'text', 'class' => 'form-control', 'rows' => 10]) !!}
                @if ($errors->has('text'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('text') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('is_published')) has-error @endif">
            <div class="switchery-demo m-b-5">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    {!! Form::hidden('is_published', 0) !!}
                    {!! Form::checkbox('is_published', 1, $review->is_published, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                    {!! Form::label('is_published', 'Опубликована', ['class' => 'control-label m-l-5']) !!}
                </div>
                <div class="col-md-6">
                    @if(!$review->published_at)
                        (сохраните, чтоб опубликовать)
                    @else
                        {{ \App\Helpers\Date::format($review->published_at) }}
                    @endif

                    @if ($errors->has('is_published'))
                        <span class="help-block error">
                            <strong>{{ $errors->first('is_published') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
        </div>
    </div><!-- end col -->

</div><!-- end row -->

@push('styles')
    <link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
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

        drEvent.on('dropify.afterClear', function(event, element){
            $('#deleteImage').val(1);
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