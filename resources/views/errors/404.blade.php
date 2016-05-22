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
                <div class="col-md-12">
                    @if($page->title)
                        <h2 class="text-uppercase">{{ $page->title }}</h2>
                    @endif
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