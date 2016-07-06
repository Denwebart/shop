<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div id="subscribeSuccess"></div>
<div id="subscribeError"></div>

{!! Form::open(['url' => route('call.request'), 'id' => 'request-call-form', 'class' => 'subscribe-form']) !!}

<div class="form-elements">
    <label for="phone" class="subscribe-form__label text-uppercase pull-left">Заказать звонок</label>

    <div class="form-group pull-left form-group__name">
        {!! Form::text('name', null, ['id' => 'name', 'class' => 'subscribe-form__input input--wd', 'placeholder' => 'Имя *']) !!}
        <span class="help-block error name_error"></span>
    </div>

    <div class="form-group pull-left form-group__phone">
        {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'subscribe-form__input input--wd', 'placeholder' => 'Телефон *']) !!}
        <span class="help-block error phone_error"></span>
    </div>

    <button type="submit" class="btn btn--wd text-uppercase wave pull-left">
        <span class="hidden-xs hidden-md">Перезвоните мне</span>
        <span class="icon icon-telephone visible-xs visible-md"></span>
    </button>
</div>
<div class="clearfix visible-sm"></div>
<div class="description">
    <p>
        Закажите звонок, и менеджер перезвонит вам
        <br class="hidden-sm">
        в течение рабочего дня call-центра.
    </p>
</div>
{!! Form::close() !!}

@push('scripts')
    <script type="text/javascript">
        jQuery(function($j) {
            $j('#request-call-form').on('submit', function(event){
                event.preventDefault ? event.preventDefault() : event.returnValue = false;

                var $form = $j(this),
                    formData = $form.serialize(),
                    url = $j(this).attr('action');

                $j.ajax({
                    url: url,
                    dataType: "json",
                    type: "POST",
                    data: formData,
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        $form.find('.has-error').removeClass('has-error');
                        $form.find('.help-block.error').text('');
                        $j('#subscribeSuccess').hide().text('');
                        $j('#subscribeError').hide().text('');

                        if(response.success){
                            $form.trigger('reset');
                            $j('#subscribeSuccess').show().html(response.message);
                        } else {
                            $j.each(response.errors, function(index, value) {
                                var errorDiv = '.' + index + '_error';
                                $form.find(errorDiv).parent().addClass('has-error');
                                $form.find(errorDiv).empty().append(value);
                            });
                            $j('#subscribeError').show().html('<i class="icon icon-info"></i> ' + response.message);
                        }
                    }
                });
            });
        });
    </script>
@endpush