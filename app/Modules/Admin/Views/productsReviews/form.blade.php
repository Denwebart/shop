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
    <div class="col-lg-5 col-sm-12 col-xs-12 m-b-15">
        <div class="row">
            <div class="col-md-3">К товару:</div>
            <div class="col-md-9">
                @if($productReview->product)
                    <h4 class="m-t-0">{{ $productReview->product->title }}</h4>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 @if($productReview->user) m-t-10 @endif">Имя:</div>
            <div class="col-md-9">
                <h4 class="m-t-0">
                    @if($productReview->user)
                        <a href="{{ route('admin.users.show', ['id' => $productReview->user->id]) }}">
                            <img src="{{ $productReview->user->getAvatarUrl() }}" class="img-circle" width="40px" alt="{{ $productReview->user->login }}">
                            <span class="m-l-5">{{ $productReview->user->login }}</span>
                        </a>
                    @else
                        {{ $productReview->user_name }}
                    @endif
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">Email:</div>
            <div class="col-md-9">
                <h4 class="m-t-0">
                    @if($productReview->user)
                        {{ $productReview->user->email }}
                    @else
                        {{ $productReview->user_email }}
                    @endif
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">Рейтинг:</div>
            <div class="col-md-9"><h4 class="m-t-0">{{ $productReview->rating }}</h4></div>
        </div>

        <div class="row">
            <div class="col-md-3">Полезен:</div>
            <div class="col-md-9"><h4 class="m-t-0">{{ $productReview->like }}</h4></div>
        </div>

        <div class="row">
            <div class="col-md-3">Не полезен:</div>
            <div class="col-md-9"><h4 class="m-t-0">{{ $productReview->dislike }}</h4></div>
        </div>

    </div><!-- end col -->

    <div class="col-lg-7 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('status')) has-error @endif">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                {!! Form::hidden('is_published', 0) !!}
                {!! Form::checkbox('is_published', 1, $productReview->is_published, ['id' => 'is_published', 'data-plugin' => 'switchery', 'data-color' => '#3bafda', 'data-size' => 'small']) !!}
                {!! Form::label('is_published', 'Опубликована', ['class' => 'control-label m-l-5']) !!}
            </div>
            <div class="col-md-6">
                @if(!$productReview->published_at)
                    (сохраните, чтоб опубликовать)
                @else
                    {{ \App\Helpers\Date::format($productReview->published_at) }}
                @endif

                @if ($errors->has('is_published'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('is_published') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group @if($errors->has('text')) has-error @endif">
            {!! Form::label('text', 'Текст отзыва', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::textarea('text', $productReview->text, ['id' => 'text', 'class' => 'form-control', 'rows' => 12]) !!}

                @if ($errors->has('text'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('text') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div><!-- end col -->

</div><!-- end row -->

@push('styles')
<link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/plugins/summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
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

</script>
@endpush