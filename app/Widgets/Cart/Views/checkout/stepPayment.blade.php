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
            <div class="checkout-steps__line step-2 done col-xs-4"></div>
            <div style="animation-delay: 0.0s;" class="checkout-steps__step col-md-4 col-sm-4 col-xs-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.0s">
                <a href="#" rel="nofollow" class="icon checkout-steps__step__icon icon-bag-alt change-step done" data-step="{{ \App\Widgets\Cart\CartController::STEP_CART }}"></a>
            </div>
            <div style="animation-delay: 0.5s;" class="checkout-steps__step col-md-4 col-sm-4 col-xs-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.5s">
                <a href="#" rel="nofollow" class="icon checkout-steps__step__icon icon-person change-step done" data-step="{{ \App\Widgets\Cart\CartController::STEP_CHECKOUT }}"></a>
            </div>
            <div style="animation-delay: 1.0s;" class="checkout-steps__step col-md-4 col-sm-4 col-xs-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="1.0s">
                <a href="#" rel="nofollow" class="icon checkout-steps__step__icon icon-money change-step done active" data-step="{{ \App\Widgets\Cart\CartController::STEP_PAYMENT }}"></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @if($page->title)
        <h2 class="text-uppercase align-center">{{ $page->title }}</h2>
    @endif

    {!! Form::open(['url' => route('cart.postPayment'), 'id' => 'payment-form']) !!}
        <div class="col-md-8 col-md-offset-2">
            <div id="error-message">
                @include('parts.message', ['class' => 'error'])
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-muted text-uppercase">Выберите способ оплаты:</h5>
                </div>
                <div class="col-md-12">
                    <div class="input-group input-group--wd m-b-10">
                        {!! Form::hidden('payment_type', null, ['id' => 'payment_type']) !!}
                        <ul class="payment-types">
                            @foreach(\App\Models\Order::$paymentTypes as $paymentType => $paymentTitle)
                                <li class="payment-types__item" data-payment-type="{{ $paymentType }}" data-description="{{ \App\Models\Order::$paymentTypesDescription[$paymentType] }}">
                                    <img src="{{ url(\App\Models\Order::$paymentTypesImage[$paymentType]) }}" alt="{{ $paymentTitle }}" class="payment-types__item__image">
                                    <span class="payment-types__item__title">
                                        {{ $paymentTitle }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                        <span class="help-block error payment_type_error">
                            {{ $errors->first('payment_type_error') }}
                        </span>
                        <p class="payment-types__item__description"></p>
                    </div>
                </div>
            </div>

            <div id="total">
                @include('widget.cart::checkout.total')
            </div>

            <div class="shopping-cart__bottom">
                <div class="row m-t-20">
                    <a href="#" class="pull-left btn text-uppercase change-step" data-step="{{ \App\Widgets\Cart\CartController::STEP_CHECKOUT }}">
                        <i class="icon icon-arrow-left"></i>
                        Назад
                    </a>

                    <div class="button-container">
                        <div class="payment-button pull-right"></div>
                        {!! Form::submit('Оформить заказ', ['class' => 'pull-right btn btn--wd text-uppercase', 'id' => 'create-order', 'disabled' => true]) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>

@push('scripts')
<script type="text/javascript">
    jQuery(function($j) {

        $j(document).on('click', '#create-order', function(event) {
            event.preventDefault ? event.preventDefault() : event.returnValue = false;
            $j("#payment-form").submit();
        });

        $j(document).on('submit', '#payment-form', function(event) {
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