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
        <div id="step-content">
            @include('widget.cart::stepCart')
        </div>
    </div>
</section>
<section class="content content--fill bottom-null">
    <div class="container">
        <h2 class="text-center">
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

        $j(document).on('click', '.change-step', function(e){
            e.preventDefault();
            var step = $j(this).data('step');

            $j.ajax({
                url: "{{ route('cart.getStep') }}",
                dataType: "json",
                type: "POST",
                data: {step: step},
                async: true,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    $j('#step-content').html(response.stepContent);

                    if ($j('.selectpicker').length) {
                        $j('.selectpicker').selectpicker({
                            showSubtext: true
                        });
                    }

                    $j('.selectpicker').on('change', function(){
                        var selected = $j(this).find("option:selected").val();
                        if (selected)
                            $j(this).addClass('used');
                        else
                            $j(this).removeClass('used');
                    });

                    $j('.input-group--wd > input, .input-group--wd > textarea, .input-group--wd > .bootstrap-select ').blur(function() {
                        var $this = $j(this);
                        if ($this.val())
                            $this.addClass('used');
                        else
                            $this.removeClass('used');
                    });
                }
            });
        });
    });
</script>
@endpush