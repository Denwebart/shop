<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
@extends('layouts.main')

@section('content')
<!-- Breadcrumb section -->

<section class="breadcrumbs  hidden-xs">
    <div class="container">
        @include('parts.breadcrumbs')
    </div>
</section>

<!-- Content section -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="checkout-steps" class="row">
                    <div style="animation-delay: 0.0s;" class="checkout-steps__step col-md-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.0s">
                        <a href="{{ route('cart.index') }}" class="icon checkout-steps__step__icon icon-bag-alt active"></a>
                    </div>
                    <div style="animation-delay: 0.5s;" class="checkout-steps__step col-md-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.5s">
                        <a href="{{ route('cart.checkout') }}" class="icon checkout-steps__step__icon icon-person active"></a>
                    </div>
                    <div style="animation-delay: 1.0s;" class="checkout-steps__step col-md-4 animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="1.0s">
                        <a href="{{ route('cart.payment') }}" class="icon checkout-steps__step__icon icon-money active"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if($page->title)
                    <h2 class="text-uppercase align-center">{{ $page->title }}</h2>
                @endif

                <div class="row step step-2">
                    {!! Form::open(['url' => route('cart.checkout.addInfo'), 'id' => 'payment-form']) !!}
                        <div class="col-md-9">
                            <div id="error-message">
                                @include('parts.message', ['class' => 'error'])
                            </div>

                            <div class="input-group input-group--wd">
                                {!! Form::text('customer[user_name]', null, ['id' => 'user_name', 'class' => 'input--full']) !!}
                                <span class="input-group__bar"></span>
                                <label>Номер карты <span class="required">*</span></label>
                                <span class="help-block error user_name_error">
                                    {{ $errors->first('user_name') }}
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-muted text-uppercase">Срок действия:</h5>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group input-group--wd">
                                        {!! Form::text('order[city]', null, ['id' => 'city', 'class' => 'input--full']) !!}
                                        <span class="input-group__bar"></span>
                                        <label>MM</label>
                                        <span class="help-block error city_error">
                                            {{ $errors->first('city') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group input-group--wd">
                                        {!! Form::text('order[postcode]', null, ['id' => 'postcode', 'class' => 'input--full']) !!}
                                        <span class="input-group__bar"></span>
                                        <label>YY</label>
                                        <span class="help-block error postcode_error">
                                            {{ $errors->first('postcode') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group--wd">
                                        {!! Form::text('order[street]', null, ['id' => 'street', 'class' => 'input--full']) !!}
                                        <span class="input-group__bar"></span>
                                        <label>Код безопасности</label>
                                        <span class="help-block error street_error">
                                            {{ $errors->first('street') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-muted text-uppercase">Имя владельца карты:</h5>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group--wd">
                                        {!! Form::text('order[city]', null, ['id' => 'city', 'class' => 'input--full']) !!}
                                        <span class="input-group__bar"></span>
                                        <label>Имя</label>
                                        <span class="help-block error city_error">
                                            {{ $errors->first('city') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group--wd">
                                        {!! Form::text('order[postcode]', null, ['id' => 'postcode', 'class' => 'input--full']) !!}
                                        <span class="input-group__bar"></span>
                                        <label>Фамилия</label>
                                        <span class="help-block error postcode_error">
                                            {{ $errors->first('postcode') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('cart.index') }}" class="pull-left btn btn--wd text-uppercase">Назад</a>
                            {!! Form::submit('Оплатить', ['class' => 'pull-right btn btn--wd text-uppercase']) !!}

                        </div>
                    {!! Form::close() !!}
                    <div class="col-md-3">
                        Общая стоимость
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content content--fill bottom-null">
    <div class="container">
        <h2 class="text-center p-b">
            Как оформить заказ?
        </h2>
        <div class="row">
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0.5s">
                <span class="dropcap custom-color m-r-10">
                    <i class="icon icon-bag-alt"></i>
                </span>
                <h5 class="title text-uppercase m-t-10">
                    Проверьте детали заказа
                </h5>
                <div class="clearfix"></div>
                <p>
                    Проверьте, правильно ли выбран размер и цвет желаемого товара.
                    <br>
                    Проверьте количество выбранных товаров и сумму покупки,
                    так как в дальнейшем это нельзя будет изменить.
                </p>
            </div>
            <div class="divider divider--sm visible-xs"></div>
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0s">
                <span class="dropcap custom-color m-r-10">
                    <i class="icon icon-person"></i>
                </span>
                <h5 class="title text-uppercase m-t-10">
                    Заполнение данные о себе
                </h5>
                <div class="clearfix"></div>
                <p>
                    Заполните данные о себе, правильно указав имя и телефон.
                    Если телефон указан неверно &mdash; заказ будет отменен.
                    <br>
                    Выберите способ доставки, обязательно указав адрес.
                </p>
            </div>
            <div class="divider divider--sm visible-xs"></div>
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0.5s">
                <span class="dropcap custom-color m-r-10">
                    <i class="icon icon-money"></i>
                </span>
                <h5 class="title text-uppercase m-t-10">
                    Оплатите заказ
                </h5>
                <div class="clearfix"></div>
                <p>
                    Выберите способ оплаты и оплатите товар.
                    Оплата заказа доступна с помощью банковских карт
                    популярных международных платёжных систем: VISA, MasterCard, Maestro.
                </p>
            </div>
        </div>
        <div class="divider divider--sm"></div>
    </div>
</section>

<!-- End Content section -->
@endsection

@push('scripts')
<script type="text/javascript">
    jQuery(function($j) {

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