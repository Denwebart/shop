<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div id="checkout-steps" class="row">
            <div class="checkout-steps__line step-1 done col-xs-4 col-xs-offset-2"></div>
            <div class="checkout-steps__line step-2 col-xs-4"></div>
            <div style="animation-delay: 0.0s;" class="checkout-steps__step col-md-4 col-sm-4 col-xs-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.0s">
                <a href="#" rel="nofollow" class="icon checkout-steps__step__icon icon-bag-alt change-step done" data-step="{{ \App\Widgets\Cart\CartController::STEP_CART }}"></a>
            </div>
            <div style="animation-delay: 0.5s;" class="checkout-steps__step col-md-4 col-sm-4 col-xs-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.5s">
                <a href="#" rel="nofollow" class="icon checkout-steps__step__icon icon-person change-step done active" data-step="{{ \App\Widgets\Cart\CartController::STEP_CHECKOUT}}"></a>
            </div>
            <div style="animation-delay: 1.0s;" class="checkout-steps__step col-md-4 col-sm-4 col-xs-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="1.0s">
                <a href="#" rel="nofollow" class="icon checkout-steps__step__icon icon-money change-step" data-step="{{ \App\Widgets\Cart\CartController::STEP_PAYMENT }}"></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @if($page->title)
        <h2 class="text-uppercase align-center">{{ $page->title }}</h2>
    @endif

    {!! Form::open(['url' => route('cart.postCheckout'), 'id' => 'checkout-form']) !!}
        <div class="col-md-8 col-md-offset-2">
            <div id="error-message">
                @include('parts.message', ['class' => 'error'])
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group--wd">
                        {!! Form::text('customer[user_name]', null, ['id' => 'user_name', 'class' => 'input--full']) !!}
                        <span class="input-group__bar"></span>
                        <label>Ваше имя <span class="required">*</span></label>
                        <span class="help-block error user_name_error">
                            {{ $errors->first('user_name') }}
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group--wd">
                        {!! Form::text('customer[phone]', null, ['id' => 'phone', 'class' => 'input--full']) !!}
                        <span class="input-group__bar"></span>
                        <label>Ваш телефон <span class="required">*</span></label>
                        <span class="help-block error phone_error">
                            {{ $errors->first('phone') }}
                        </span>
                    </div>
                </div>
            </div>

            <?php $deliveryTypes = \App\Models\DeliveryType::getDeliveryTypes() ?>
            @if(count($deliveryTypes) > 1)
                <div class="input-group input-group--wd m-t-20">
                    {{--<label class="static-label">Способ доставки <span class="required">*</span></label>--}}
                    {!! Form::select('order[delivery_type]', ['' => ' '] + $deliveryTypes, null, ['id' => 'delivery_type', 'class' => 'selectpicker', 'data-style' => 'select--wd select--wd--sm select--wd--full']) !!}
                    <span class="input-group__bar"></span>
                    <label>Способ доставки <span class="required">*</span></label>
                    <span class="help-block error delivery_type_error">
                        {{ $errors->first('order[delivery_type]') }}
                    </span>
                </div>
            @endif

            <div id="address" class="row">
                <div class="col-md-12">
                    <h5 class="text-muted text-uppercase">Адрес доставки:</h5>
                </div>

                <div class="col-md-6">
                    <div class="input-group input-group--wd">
                        {!! Form::text('order[city]', null, ['id' => 'city', 'class' => 'input--full']) !!}
                        <span class="input-group__bar"></span>
                        <label>Город</label>
                        <span class="help-block error city_error">
                            {{ $errors->first('city') }}
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group input-group--wd">
                        {!! Form::text('order[postcode]', null, ['id' => 'postcode', 'class' => 'input--full']) !!}
                        <span class="input-group__bar"></span>
                        <label>Почтовый индекс</label>
                        <span class="help-block error postcode_error">
                            {{ $errors->first('postcode') }}
                        </span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="input-group input-group--wd">
                        {!! Form::text('order[address]', null, ['id' => 'street', 'class' => 'input--full']) !!}
                        <span class="input-group__bar"></span>
                        <label>Арес доставки</label>
                        <span class="help-block error street_error">
                            {{ $errors->first('street') }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="input-group input-group--wd">
                {!! Form::textarea('comment', null, ['id' => 'comment', 'class' => 'input--full', 'rows' => '3']) !!}
                <span class="input-group__bar"></span>
                <label>Комментарий к заказу</label>
                <span class="help-block error comment_error">
                    {{ $errors->first('comment') }}
                </span>
            </div>

            <a href="#" class="pull-left btn text-uppercase change-step" data-step="{{ \App\Widgets\Cart\CartController::STEP_CART }}">
                <i class="icon icon-arrow-left"></i>
                Назад
            </a>
            <a href="#" class="pull-right btn btn--wd text-uppercase change-step" data-step="{{ \App\Widgets\Cart\CartController::STEP_PAYMENT }}">Перейти к оплате</a>
        </div>
    {!! Form::close() !!}
</div>

@push('scripts')
<script type="text/javascript">
    jQuery(function($j) {
        $j(document).on('click', '.change-step', function(e) {
            e.preventDefault();
            if($j(this).data('step') == "{{ \App\Widgets\Cart\CartController::STEP_PAYMENT }}") {
                $j('#checkout-form').submit();
            }
        });

        $j(document).on('submit', '#checkout-form', function(event){
            event.preventDefault ? event.preventDefault() : event.returnValue = false;

            var $form = $j(this),
                formData = $form.serialize(),
                url = $form.attr('action');

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
                    $j('#error-message').hide().find('.infobox__text').text('');

                    $j('html, body').animate({
                        scrollTop: $j('#checkout-steps').offset().top - 100
                    }, 1000);

                    if(response.success){
                        $form.trigger('reset');
                    } else {
                        $j.each(response.errors, function(index, value) {
                            var errorDiv = '.' + index + '_error';
                            $form.find(errorDiv).parent().addClass('has-error');
                            $form.find(errorDiv).empty().append(value);
                        });
                        $j('#error-message').show().find('.infobox__text').text(response.message);
                    }
                }
            });
        });
    });
</script>
@endpush