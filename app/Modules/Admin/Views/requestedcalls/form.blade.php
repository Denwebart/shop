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
        <div class="form-group">
            <div class="col-md-2">Имя:</div>
            <div class="col-md-10">
                <h4 class="m-t-0">{{ $call->name }}</h4>
                {!! Form::hidden('name', $call->name) !!}
            </div>

            <div class="col-md-2">Телефон:</div>
            <div class="col-md-10">
                <h4 class="m-t-0">{{ \App\Helpers\Str::phoneFormat($call->phone) }}</h4>
                {!! Form::hidden('phone', $call->phone) !!}
            </div>

            <div class="col-md-2">Заказан:</div>
            <div class="col-md-10"><h4 class="m-t-0">{{ \App\Helpers\Date::format($call->created_at) }}</h4></div>

            <div class="col-md-2">Обработан:</div>
            <div class="col-md-10"><h4 class="m-t-0">{{ \App\Helpers\Date::format($call->answered_at) }}</h4></div>

            <div class="col-md-2 @if($call->user) m-t-15 @endif">Менеджер:</div>

            <div class="col-md-10 @if($call->user) m-t-5 @endif">
                <h4 class="m-t-0">
                    @if($call->user)
                        <a href="{{ route('admin.users.show', ['id' => $call->user->id]) }}">
                            <img src="{{ $call->user->getAvatarUrl() }}" class="img-circle" width="40px" alt="{{ $call->user->login }}" title="Ответил {{ $call->user->login }}" data-toggle="tooltip" data-placement="right">
                            <span class="m-l-5">{{ $call->user->login }}</span>
                        </a>
                    @else
                        -
                    @endif
                </h4>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-7 col-sm-12 col-xs-12 m-b-15">
        <div class="form-group @if($errors->has('status')) has-error @endif">
            {!! Form::label('status', 'Статус', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::select('status', \App\Models\RequestedCall::$statuses, $call->status, ['id' => 'status', 'class' => 'form-control']) !!}
                @if ($errors->has('status'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group @if($errors->has('comment')) has-error @endif">
            {!! Form::label('comment', 'Комментарий', ['class' => 'col-md-2 control-label']) !!}
            <div class="col-md-10">
                {!! Form::textarea('comment', $call->comment, ['id' => 'comment', 'class' => 'form-control', 'rows' => 5]) !!}

                <span class="help-block @if($errors->has('comment')) hidden @endif">
                    <small>Заметка о звонке.</small>
                </span>
                @if ($errors->has('comment'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('comment') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div><!-- end col -->

</div><!-- end row -->


@push('scripts')
    <script type="text/javascript">

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