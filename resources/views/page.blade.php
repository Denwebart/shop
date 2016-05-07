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
        <ol class="breadcrumb breadcrumb--wd pull-left">
            <li><a href="{{ url('/') }}">Главная</a></li>
            <li class="active">{{ $page->getTitle() }}</li>
        </ol>
    </div>
</section>

<!-- Content section -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @if($page->title)
                    <h2 class="text-uppercase">{{ $page->title }}</h2>
                @endif

                {!! $page->content !!}
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12 animation" data-animation="fadeInRight" data-animation-delay="0s">
                        <div class="card card--icon">
                            <div class="card--icon__cell">
                                <a href="#" class="icon card--icon__cell__icon icon-money"></a>
                                <h5 class="card--icon__cell__title text-uppercase">Онлайн оплата</h5>
                            </div>
                            <div class="card--icon__text text-center">
                                <em>
                                    Возможность оплаты картами VISA, MasterCard, Maestro.
                                </em>
                            </div>
                        </div>
                    </div>
                    <div class="divider divider--sm"></div>
                    <div class="col-md-12 animation" data-animation="fadeInRight" data-animation-delay="0.3s">
                        <div class="card card--icon">
                            <div class="card--icon__cell">
                                <a href="#" class="icon card--icon__cell__icon icon-truck"></a>
                                <h5 class="card--icon__cell__title text-uppercase">Быстрая доставка</h5>
                            </div>
                            <div class="card--icon__text text-center">
                                <em>
                                    Доставка курьерскими службами "Новая почта", "Интайм" и пр.
                                </em>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content content--fill bottom-null">
    <div class="container">
        <h2 class="text-center">
            Вывод последних 3-х каких-нибудь статей,
            например новостей или акций.
        </h2>
        <div class="row">
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0.5s">
                <h5 class="title text-uppercase">
                    <a href="#">
                        Далеко за горами живут рыбные тексты.
                    </a>
                </h5>
                <p>
                    Далеко-далеко за словесными горами в стране
                    гласных и согласных живут рыбные тексты. Вдали
                    от всех живут они в буквенных домах на берегу
                    Семантика большого языкового океана. Маленький
                    ручеек Даль журчит по всей стране и обеспечивает
                    ее всеми необходимыми правилами. Эта парадигматическая
                    страна.
                </p>
                <div class="divider divider--xs"></div>
                <a href="#" class="btn btn--wd pull-right text-uppercase">Читать длее</a>
            </div>
            <div class="divider divider--sm visible-xs"></div>
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0s">
                <h5 class="title text-uppercase">
                    <a href="#">
                        Вдали от всех живут они в буквенных домах.
                    </a>
                </h5>
                <p>
                    Далеко-далеко за словесными горами в стране
                    гласных и согласных живут рыбные тексты. Вдали
                    от всех живут они в буквенных домах на берегу
                    Семантика большого языкового океана. Маленький
                    ручеек Даль журчит по всей стране и обеспечивает
                    ее всеми необходимыми правилами. Эта парадигматическая
                    страна.
                </p>
                <div class="divider divider--xs"></div>
                <a href="#" class="btn btn--wd pull-right text-uppercase">Читать длее</a>
            </div>
            <div class="divider divider--sm visible-xs"></div>
            <div class="col-sm-4 animation" data-animation="fadeInUp" data-animation-delay="0.5s">
                <h5 class="title text-uppercase">
                    <a href="#">
                        Маленький ручеек Даль журчит по всей стране.
                    </a>
                </h5>
                <p>
                    Далеко-далеко за словесными горами в стране
                    гласных и согласных живут рыбные тексты. Вдали
                    от всех живут они в буквенных домах на берегу
                    Семантика большого языкового океана. Маленький
                    ручеек Даль журчит по всей стране и обеспечивает
                    ее всеми необходимыми правилами. Эта парадигматическая
                    страна.
                </p>
                <div class="divider divider--xs"></div>
                <a href="#" class="btn btn--wd pull-right text-uppercase">Читать длее</a>
            </div>
        </div>
        <div class="divider divider--sm"></div>
    </div>
</section>
<!-- End Content section -->
@endsection
