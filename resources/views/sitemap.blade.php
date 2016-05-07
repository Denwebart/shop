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
            @if($page->title)
                <h2 class="text-uppercase">{{ $page->title }}</h2>
            @endif

            {!! $page->content !!}

            <div id="sitemap">
                <ul>
                    <li>
                        <a href="index.html">Главная</a>
                    </li>
                    <li>
                        <a href="about.html">О магазине</a>
                    </li>
                    <li>
                        <a href="listing-open-filter.html">Каталог</a>
                        <ul>
                            <li>
                                <a href="listing-open-filter.html">Пальто</a>
                                <ul>
                                    <li><a href="product.html">Пальто демисезонное</a></li>
                                    <li><a href="product.html">Пальто зимнее с капюшоном</a></li>
                                    <li><a href="product.html">Пальто с воротником</a></li>
                                    <li><a href="product.html">Пальто черное</a></li>
                                    <li><a href="product.html">Пальто демисезонное</a></li>
                                    <li><a href="product.html">Пальто зимнее теплое</a></li>
                                    <li><a href="product.html">Пальто демисезонное</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="listing-open-filter.html">Плащи</a>
                                <ul>
                                    <li><a href="product.html">Плащ осенний</a></li>
                                    <li><a href="product.html">Плащ черный длинный</a></li>
                                    <li><a href="product.html">Плащ весенний легкий</a></li>
                                    <li><a href="product.html">Плащ бежевый</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="listing-open-filter.html">Куртки</a>
                                <ul>
                                    <li><a href="product.html">Куртка весенняя</a></li>
                                    <li><a href="product.html">Куртка демисезонная</a></li>
                                    <li><a href="product.html">Куртка зимняя</a></li>
                                    <li><a href="product.html">Куртка осенняя</a></li>
                                    <li><a href="product.html">Куртка красная теплая</a></li>
                                    <li><a href="product.html">Куртка с капюшоном</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="listing-open-filter.html">Шубы</a>
                                <ul>
                                    <li><a href="product.html">Шуба натральная</a></li>
                                    <li><a href="product.html">Шубка короткая</a></li>
                                    <li><a href="product.html">Шуба с большим воротником</a></li>
                                    <li><a href="product.html">Шуба норковая</a></li>
                                    <li><a href="product.html">Шуба зимняя</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="sitemap.html">Новости и статьи</a>
                    </li>
                    <li>
                        <a href="contact.html">Контакты</a>
                    </li>
                    <li>
                        <a href="about.html">Оплата и доставка</a>
                    </li>
                    <li>
                        <a href="faq.html">Вопросы и ответы</a>
                    </li>
                    <li>
                        <a href="sitemap.html">Карта сайта</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Content section -->
@endsection