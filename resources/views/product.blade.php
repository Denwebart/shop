<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.main')

@section('content')
    <!-- Breadcrumb section -->
    <section class="breadcrumbs breadcrumbs-boxed">
        <div class="container">
            @include('parts.breadcrumbs')

            <ul id="productOther" class="product-other pull-right hidden-xs">
                <li class="product-other__link product-prev">
                    <a href="product.html">Пальто демисезонное</a>
                        <span class="product-other__link__image">
                            <img src='images/5-red.JPG'/>
                        </span>
                </li>
                <li class="product-other__link product-next">
                    <a href="product.html">Элегантное демисезонное пальто</a>
                        <span class="product-other__link__image">
                            <img src='images/2-black.JPG'/>
                        </span>
                </li>
            </ul>
        </div>
    </section>

    <!-- Content section -->
    <section class="content">
        <div class="container">
            <div class="row product-info-outer">
                <div class="col-sm-4 col-md-4 col-lg-5 hidden-xs">
                    <div class="product-main-image">
                        <div class="product-main-image__item">
                            <img class="product-zoom" src='{{ $page->getImageUrl() }}' data-zoom-image="{{ $page->getImageUrl('zoom') }}"/>
                        </div>
                        <div class="product-main-image__zoom"></div>
                    </div>
                    <div class="product-images-carousel">
                        <ul id="smallGallery">
                            <li>
                                <a href="#" data-image="images/product-red.jpg" data-zoom-image="images/product-red.jpg">
                                    <img src="images/product-red.jpg" alt=""/>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-image="images/product-red-2.jpg" data-zoom-image="images/product-red-2.jpg">
                                    <img src="images/product-red-2.jpg" alt=""/>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-image="images/product-red-3.jpg" data-zoom-image="images/product-red-3.jpg">
                                    <img src="images/product-red-3.jpg" alt=""/>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-image="images/product-red-4.jpg" data-zoom-image="images/product-red-4.jpg">
                                    <img src="images/product-red-4.jpg" alt=""/>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-image="images/product-yellow.jpg" data-zoom-image="images/product-yellow.jpg">
                                    <img src="images/product-yellow.jpg" alt=""/>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-image="images/product-grey.jpg" data-zoom-image="images/product-grey.jpg">
                                    <img src="images/product-grey.jpg" alt=""/>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-image="images/product-green.jpg" data-zoom-image="images/product-green.jpg">
                                    <img src="images/product-green.jpg" alt=""/>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-image="images/product-blue.jpg" data-zoom-image="images/product-blue.jpg">
                                    <img src="images/product-blue.jpg" alt=""/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="product-info col-sm-8 col-md-4 col-lg-4">
                    <div class="product-info__title">
                        <h2>{{ $page->title }}</h2>
                        <div class="rating product-info__rating visible-xs">
                            <span class="icon-star"></span>
                            <span class="icon-star"></span>
                            <span class="icon-star"></span>
                            <span class="icon-star"></span>
                        </div>
                    </div>
                    <div class="product-info__sku pull-right">
                        Артикул: 00065 &nbsp;&nbsp;
                        <span class="label label-success">В НАЛИЧИИ</span>
                    </div>
                    <ul id="singleGallery" class="visible-xs">
                        <li><img src="images/product-red.jpg" alt="" /></li>
                        <li><img src="images/product-red-2.jpg" alt=""/></li>
                        <li><img src="images/product-red-3.jpg" alt=""/></li>
                        <li><img src="images/product-red-4.jpg" alt=""/></li>
                        <li><img src="images/product-yellow.jpg" alt=""/></li>
                        <li><img src="images/product-grey.jpg" alt=""/></li>
                        <li><img src="images/product-green.jpg" alt=""/></li>
                        <li><img src="images/product-blue.jpg" alt=""/></li>
                    </ul>
                    <div class="price-box product-info__price">
                        <span class="price-box__new">5 000 руб.</span>
                        <span class="price-box__old">7 000 руб.</span>
                    </div>
                    <div class="rating product-info__rating hidden-xs">
                        <span class="icon-star"></span>
                        <span class="icon-star"></span>
                        <span class="icon-star"></span>
                        <span class="icon-star"></span>
                        <span class="icon-star"></span>
                    </div>
                    <!--<div class="divider divider&#45;&#45;xs product-info__divider"></div>-->
                    <!--<div class="product-info__description">-->
                    <!--Далеко-далеко за словесными горами в стране гласных и согласных живут-->
                    <!--рыбные тексты. Вдали от всех живут они в буквенных домах-->
                    <!--на берегу Семантика большого языкового океана. Маленький ручеек-->
                    <!--Даль журчит по всей стране и обеспечивает ее всеми необходимыми-->
                    <!--правилами. Эта парадигматическая страна, в которой жаренные члены-->
                    <!--предложения залетают прямо в рот. Даже всемогущая пунктуация не-->
                    <!--имеет власти над рыбными текстами, ведущими безорфографичный образ-->
                    <!--жизни. Однажды одна маленькая строчка рыбного текста по имени Lorem-->
                    <!--ipsum решила выйти в большой мир грамматики.-->
                    <!--</div>-->
                    <!--<div class="divider divider&#45;&#45;xs product-info__divider"></div>-->
                    <label>Размер:</label>
                    <ul class="options-swatch options-swatch--size options-swatch--lg">
                        <li>XS</li>
                        <li>S</li>
                        <li>M</li>
                        <li>L</li>
                        <li>XL</li>
                        <li>XXL</li>
                        <li>XXXL</li>
                    </ul>
                    <div class="divider divider--xs"></div>
                    <label>Цвет:</label>
                    <ul class="options-swatch options-swatch--color options-swatch--lg">
                        <li>
                            <a href="#">
                                    <span class="swatch-label">
                                        <img src="images/colors/blue.png" width="10" height="10" alt=""/>
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                    <span class="swatch-label">
                                        <img src="images/colors/yellow.png" width="10" height="10" alt=""/>
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                    <span class="swatch-label">
                                        <img src="images/colors/green.png" width="10" height="10" alt=""/>
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                    <span class="swatch-label">
                                        <img src="images/colors/dark-grey.png" width="10" height="10" alt=""/>
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                    <span class="swatch-label">
                                        <img src="images/colors/grey.png" width="10" height="10" alt=""/>
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                    <span class="swatch-label">
                                        <img src="images/colors/red.png" width="10" height="10" alt=""/>
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                    <span class="swatch-label">
                                        <img src="images/colors/white.png" width="10" height="10" alt=""/>
                                    </span>
                            </a>
                        </li>
                    </ul>
                    <div class="divider divider--sm"></div>
                    <label>Количество:</label>
                    <div class="outer">
                        <div class="input-group-qty pull-left">
                            <span class="pull-left"> </span>
                            <input type="text" name="quant[1]" class="input-number input--wd input-qty pull-left" value="1" min="1" max="100">
                                <span class="pull-left btn-number-container">
                                <button type="button" class="btn btn-number btn-number--plus" data-type="plus" data-field="quant[1]">
                                    +
                                </button>
                                <button type="button" class="btn btn-number btn-number--minus" disabled="disabled" data-type="minus" data-field="quant[1]"> &#8211;</button>
                            </span>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn--wd text-uppercase">Добавить в корзину</button>
                        </div>
                    </div>
                    <div class="divider divider--xs"></div>
                    <ul class="product-links product-links--inline">
                        <li>
                            <a href="#">
                                <span class="icon icon-favorite"></span>
                                <span class="dashed-bottom">Добавить в список желаний</span>
                            </a>
                        </li>
                    </ul>
                    <div class="social-links social-links--colorize social-links--invert social-links--padding pull-left">
                        <ul>
                            <li class="social-links__item">
                                <a class="icon icon-vk tooltip-link" href="#" data-placement="top" data-toggle="tooltip" data-original-title="Поделиться ВКонтакте"></a>
                            </li>
                            <li class="social-links__item">
                                <a class="icon icon-facebook tooltip-link" href="#" data-placement="top" data-toggle="tooltip" data-original-title="Поделиться в Facebook"></a>
                            </li>
                            <li class="social-links__item">
                                <a class="icon icon-instagram tooltip-link" href="#" data-placement="top" data-toggle="tooltip" data-original-title="Поделиться в Instagram"></a>
                            </li>
                            <li class="social-links__item">
                                <a class="icon icon-twitter tooltip-link" href="#" data-placement="top" data-toggle="tooltip" data-original-title="Поделиться в Twitter"></a>
                            </li>
                            <li class="social-links__item">
                                <a class="icon icon-google tooltip-link" href="#" data-placement="top" data-toggle="tooltip" data-original-title="Поделиться в Google+"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <h4>Дополнительная информация</h4>
                    <div class="card">
                        <div class="card__row">
                            Вы можете добавить свой контент здесь,
                            например акции или какую-то дополнительной информации
                            по оплате и доставке.
                        </div>
                        <div href="#" class="card__row card__row--icon">
                            <div class="card__row--icon__icon">
                                <span class="icon icon-money"></span>
                            </div>
                            <div class="card__row--icon__text">
                                <div class="card__row__title">Оплата online</div>
                                Оплата картами VISA, MasterCard, Maestro
                            </div>
                        </div>
                        <div class="card__row card__row--icon">
                            <div class="card__row--icon__icon">
                                <span class="icon icon-truck"></span>
                            </div>
                            <div class="card__row--icon__text">
                                <div class="card__row__title">Быстрая доставка</div>
                                Доставка курьерскими службами "Новая почта", "Интайм" и пр.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content content--fill">
        <div class="container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs--wd" role="tablist">
                <li class="active">
                    <a href="#Tab1" aria-controls="home" role="tab" data-toggle="tab" class="text-uppercase">
                        Описание
                    </a>
                </li>
                <li><a href="#Tab2" role="tab" data-toggle="tab" class="text-uppercase">Отзывы (20)</a></li>
                <li><a href="#Tab5" role="tab" data-toggle="tab" class="text-uppercase">Таблица размеров</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content tab-content--wd">
                <div role="tabpanel" class="tab-pane active" id="Tab1">
                    <p>
                        Далеко-далеко за словесными горами в стране гласных и согласных живут
                        рыбные тексты. Вдали от всех живут они в буквенных домах на берегу
                        Семантика большого языкового океана. Маленький ручеек Даль журчит
                        по всей стране и обеспечивает ее всеми необходимыми правилами.
                        Эта парадигматическая страна, в которой жаренные члены
                        предложения залетают прямо в рот. Даже всемогущая
                        пунктуация не имеет власти над рыбными текстами,
                        ведущими безорфографичный образ жизни.
                    </p>
                    <p>
                        Однажды одна
                        маленькая строчка рыбного текста по имени Lorem ipsum решила
                        выйти в большой мир грамматики. Великий Оксмокс предупреждал ее о
                        злых запятых, диких знаках вопроса и коварных точках с запятой, но текст
                        не дал сбить себя с толку. Он собрал семь своих заглавных букв, подпоясал
                        инициал за пояс и пустился в дорогу. Взобравшись на первую вершину курсивных
                        гор, бросил он последний взгляд назад, на силуэт своего родного города Буквоград,
                        на заголовок деревни Алфавит и на подзаголовок своего переулка Строчка. Грустный
                        реторический вопрос скатился по его щеке и он продолжил свой путь. По дороге
                        встретил текст рукопись. Она предупредила его: «В моей стране все переписывается
                        по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся
                        ты лучше в свою безопасную страну».
                    </p>
                    <div class="divider divider--xs"></div>
                    <table class="table table-params">
                        <tbody>
                        <tr>
                            <td class="text-right"><strong>Сезон</strong></td>
                            <td>Весна, Осень</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Материал</strong></td>
                            <td>Плащевка</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Длина</strong></td>
                            <td>68 см</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Застежка</strong></td>
                            <td>молния,кнопки</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="Tab2">
                    <p class="hidden">Оставьте первым свой отзыв!</p>
                    <div class="row">
                        <div class="col-sm-5 col-md-4 col-lg-3">
                            <h3 class="text-uppercase">Отзывы (20)</h3>
                            <div class="rating-extended row">
                                <div class="col-lg-12">
                                    <h1 class="rating-extended__num pull-left"> 4.75</h1>
                                    <div class="rating">
                                        <span class="icon icon-star"></span>
                                        <span class="icon icon-star"></span>
                                        <span class="icon icon-star"></span>
                                        <span class="icon icon-star"></span>
                                        <span class="icon icon-star empty-star"></span>
                                    </div>
                                    <div><span class="icon icon-man"></span>Отзывов: 20</div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12">
                                    <div class="progress">
                                        <span class="rating-extended__label">5 звезд</span>
                                        <div class="progress-bar progress-bar-five" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="rating-extended__reviews-count">10</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress">
                                        <span class="rating-extended__label">4 звезды</span>
                                        <div class="progress-bar progress-bar-four" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="rating-extended__reviews-count">4</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress">
                                        <span class="rating-extended__label">3 звезды</span>
                                        <div class="progress-bar progress-bar-three" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="rating-extended__reviews-count">3</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress">
                                        <span class="rating-extended__label">2 звезды</span>
                                        <div class="progress-bar progress-bar-two" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 15%">
                                            <span class="rating-extended__reviews-count">2</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress">
                                        <span class="rating-extended__label">1 звезда</span>
                                        <div class="progress-bar progress-bar-one" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                                            <span class="rating-extended__reviews-count">1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider divider--md"></div>
                        </div>
                        <div class="col-sm-7 col-md-8 col-lg-9">
                            <div class="count">
                                Показано 2 из 20
                            </div>
                            <div class="review">
                                <div class="rating"><span class="icon icon-star"></span><span
                                            class="icon icon-star"></span><span class="icon icon-star"></span><span
                                            class="icon icon-star"></span><span class="icon icon-star empty-star"></span>
                                </div>
                                <h5 class="review__title">Очень понравился!</h5>
                                <div class="review__content">
                                    Маленький ручеек Даль журчит
                                    по всей стране и обеспечивает ее всеми необходимыми правилами.
                                    Эта парадигматическая страна, в которой жаренные члены
                                    предложения залетают прямо в рот. Даже всемогущая
                                    пунктуация не имеет власти над рыбными текстами,
                                    ведущими безорфографичный образ жизни.
                                </div>
                                <div class="review__meta">
                                    <strong>Валентина</strong>,
                                    17 апреля 2016
                                </div>
                                <div class="review__comments"><a href="#">Комментарии (1)</a></div>
                                <div class="review__helpful">Этот отзыв был полезен?
                                    <a href="#">Да</a>
                                    <a href="#">Нет</a>
                                </div>
                            </div>
                            <div class="review">
                                <div class="rating"><span class="icon icon-star"></span><span
                                            class="icon icon-star"></span><span class="icon icon-star"></span><span
                                            class="icon icon-star"></span><span class="icon icon-star"></span>
                                </div>
                                <h5 class="review__title">Отлично!</h5>
                                <div class="review__content">
                                    Далеко-далеко за словесными горами в стране гласных и согласных живут
                                    рыбные тексты. Вдали от всех живут они в буквенных домах на берегу
                                    Семантика большого языкового океана.
                                </div>
                                <div class="review__meta">
                                    <strong>Наталья</strong>,
                                    25 Марта, 2016
                                </div>
                                <div class="review__comments"><a href="#">Комментарии (1)</a></div>
                                <div class="review__helpful">Этот отзыв был полезен?
                                    <a href="#">Да</a>
                                    <a href="#">Нет</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider divider--xs"></div>
                    <div class="row">
                        <div class="col-sm-5 col-md-4 col-lg-3">

                        </div>
                        <div class="col-sm-7 col-md-8 col-lg-9">
                            <form action="#" class="contact-form">
                                <h4>Оставить отзыв</h4>

                                <label>Имя<span class="required">*</span></label>
                                <input type="text" class="input--wd input--wd--full">
                                <label>Заголовок<span class="required">*</span></label>
                                <input type="text" class="input--wd input--wd--full">
                                <label>Отзыв<span class="required">*</span></label>
                                <textarea class="textarea--wd input--wd--full"></textarea>
                                <div class="divider divider--xs"></div>
                                <button type="submit" class="btn btn--wd text-uppercase wave">
                                    Отправить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="Tab5">
                    <div class="table-responsive">
                        <table class="table table-params">
                            <tbody>
                            <tr>
                                <td><strong>Размер</strong></td>
                                <td><strong>48</strong></td>
                                <td><strong>50</strong></td>
                                <td><strong>52</strong></td>
                                <td><strong>54</strong></td>
                                <td><strong>56</strong></td>
                                <td><strong>58</strong></td>
                                <td><strong>60</strong></td>
                                <td><strong>62</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Обхват груди</strong></td>
                                <td><span>92/96</span></td>
                                <td><span>96/100</span></td>
                                <td><span>100/104</span></td>
                                <td><span>104/108</span></td>
                                <td><span>108/112</span></td>
                                <td><span>112/116</span></td>
                                <td><span>116/120</span></td>
                                <td><span>120/124</span></td>
                            </tr>
                            <tr>
                                <td><strong>Обхват бедер</strong></td>
                                <td><span>100/104</span></td>
                                <td><span>104/108</span></td>
                                <td><span>108/112</span></td>
                                <td><span>112/116</span></td>
                                <td><span>116/120</span></td>
                                <td><span>120/124</span></td>
                                <td><span>124/128</span></td>
                                <td><span>128/132</span></td>
                            </tr>
                            <tr>
                                <td><strong>Длина по спинке</strong></td>
                                <td><span>88</span></td>
                                <td><span>89</span></td>
                                <td><span>90</span></td>
                                <td><span>92</span></td>
                                <td><span>93</span></td>
                                <td><span>95</span></td>
                                <td><span>96</span></td>
                                <td><span>97</span></td>
                            </tr>
                            <tr>
                                <td><strong>Длина по полочке</strong></td>
                                <td><span>80</span></td>
                                <td><span>80</span></td>
                                <td><span>82</span></td>
                                <td><span>83</span></td>
                                <td><span>85</span></td>
                                <td><span>86</span></td>
                                <td><span>88</span></td>
                                <td>89</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <h2 class="text-center text-uppercase">Недавно просмотренные</h2>
            <div class="row product-carousel mobile-special-arrows animated-arrows product-grid four-in-row">
                <div class="product-preview-wrapper">
                    <div class="product-preview open">
                        <div class="product-preview__image"><a href="#"><img
                                        src="images/product-empty.png" data-lazy="images/1-yellow-blond.JPG"
                                        alt=""/></a></div>
                        <div class="product-preview__info text-center">
                            <div class="product-preview__info__btns"><a href="#"
                                                                        class="btn btn--round ajax-to-cart"><span
                                            class="icon-ecommerce"></span></a></div>
                            <div class="product-preview__info__title">
                                <h2><a href="product.html">Пальто демисезонное</a></h2>
                            </div>
                            <ul class="options-swatch options-swatch--color">
                                <li class="color-blue"></li>
                                <li class="color-yellow"></li>
                                <li class="color-green"></li>
                                <li class="color-dark-grey"></li>
                                <li class="color-grey"></li>
                                <li class="color-red"></li>
                                <li class="color-white"></li>
                            </ul>
                            <div class="price-box">5 000 руб.</div>
                            <div class="product-preview__info__description">
                                <p>Nulla at mauris leo. Donec quis ex elementum, tincidunt elit quis, cursus tortor.
                                    Sed sollicitudin enim metus, ut hendrerit orci dignissim venenatis.</p>
                                <p>Suspendisse consectetur odio diam, ut consequat quam aliquet at.</p>
                            </div>
                            <div class="product-preview__info__link">
                                <a href="#" class="ajax-to-wishlist"><span class="icon icon-favorite"></span><span
                                            class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span></a><a
                                        href="#" class="btn btn--wd buy-link"><span
                                            class="icon icon-ecommerce"></span><span
                                            class="product-preview__info__link__text">Добавить в корзину</span></a></div>
                        </div>
                    </div>
                </div>
                <div class="product-preview-wrapper">
                    <div class="product-preview open">
                        <div class="product-preview__image">
                            <a href="product.html">
                                <img src="images/product-empty.png" data-lazy="images/2-black.JPG" alt=""/>
                            </a>
                        </div>
                        <div class="product-preview__label product-preview__label--left product-preview__label--new">
                            <span>новое</span>
                        </div>
                        <div class="product-preview__label product-preview__label--right product-preview__label--sale">
                            <span>скидка<br>-10%</span>
                        </div>
                        <div class="product-preview__info text-center">
                            <div class="product-preview__info__btns">
                                <a href="#" class="btn btn--round ajax-to-cart">
                                    <span class="icon-ecommerce"></span>
                                </a>
                            </div>
                            <div class="product-preview__info__title">
                                <h2><a href="product.html">Пальто демисезонное</a></h2>
                            </div>
                            <div class="price-box">
                                <span class="price-box__new">5 000 руб.</span>
                                <span class="price-box__old">7 000 руб.</span>
                            </div>
                            <div class="product-preview__info__description">
                                <p>Nulla at mauris leo. Donec quis ex elementum, tincidunt elit quis, cursus tortor.
                                    Sed sollicitudin enim metus, ut hendrerit orci dignissim venenatis.</p>
                                <p>Suspendisse consectetur odio diam, ut consequat quam aliquet at.</p>
                            </div>
                            <div class="product-preview__info__link">
                                <a href="#" class="ajax-to-wishlist">
                                    <span class="icon icon-favorite"></span>
                                        <span class="product-preview__info__link__text dashed-bottom">
                                            Добавить в список желаний
                                        </span>
                                </a>
                                <a href="#" class="btn btn--wd buy-link">
                                    <span class="icon icon-ecommerce"></span>
                                        <span class="product-preview__info__link__text dashed-bottom">
                                            Добавить в корзину
                                        </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-preview-wrapper">
                    <div class="product-preview open">
                        <div class="product-preview__image">
                            <a href="product.html">
                                <img src="images/product-empty.png" data-lazy="images/8-pink.JPG" alt=""/>
                            </a>
                            <div class="product-preview__outstock">Продано</div>
                        </div>
                        <div class="product-preview__info text-center">
                            <div class="product-preview__info__btns">
                                <a href="#" class="btn btn--round ajax-to-cart">
                                    <span class="icon-ecommerce"></span>
                                </a>
                            </div>
                            <div class="product-preview__info__title">
                                <h2><a href="product.html">Пальто демисезонное</a></h2>
                            </div>
                            <div class="price-box">5 000 руб.</div>
                            <div class="product-preview__info__description">
                                <p>Nulla at mauris leo. Donec quis ex elementum, tincidunt elit quis, cursus tortor.
                                    Sed sollicitudin enim metus, ut hendrerit orci dignissim venenatis.</p>
                                <p>Suspendisse consectetur odio diam, ut consequat quam aliquet at.</p>
                            </div>
                            <div class="product-preview__info__link">
                                <a href="#" class="ajax-to-wishlist"><span class="icon icon-favorite"></span><span
                                            class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span></a><a
                                        href="#" class="btn btn--wd buy-link"><span
                                            class="icon icon-ecommerce"></span><span
                                            class="product-preview__info__link__text">Добавить в корзину</span></a></div>
                        </div>
                    </div>
                </div>
                <div class="product-preview-wrapper">
                    <div class="product-preview open">
                        <div class="product-preview__image">
                            <a href="product.html">
                                <img src="images/product-empty.png" data-lazy="images/5-red.JPG" alt=""/>
                            </a>
                            <div class="countdown_box">
                                <div class="countdown_inner">
                                    <div class="title">специальная цена:</div>
                                    <div id="countdown1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview__info text-center">
                            <div class="product-preview__info__btns">
                                <a href="#" class="btn btn--round ajax-to-cart">
                                    <span class="icon-ecommerce"></span>
                                </a>
                            </div>
                            <div class="product-preview__info__title">
                                <h2><a href="product.html">Пальто демисезонное</a></h2>
                            </div>
                            <div class="price-box">5 000 руб.</div>
                            <div class="product-preview__info__description">
                                <p>Nulla at mauris leo. Donec quis ex elementum, tincidunt elit quis, cursus tortor.
                                    Sed sollicitudin enim metus, ut hendrerit orci dignissim venenatis.</p>
                                <p>Suspendisse consectetur odio diam, ut consequat quam aliquet at.</p>
                            </div>
                            <div class="product-preview__info__link">
                                <a href="#" class="ajax-to-wishlist"><span class="icon icon-favorite"></span><span
                                            class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span></a><a
                                        href="#" class="btn btn--wd buy-link"><span
                                            class="icon icon-ecommerce"></span><span
                                            class="product-preview__info__link__text">Добавить в корзину</span></a></div>
                        </div>
                    </div>
                </div>
                <div class="product-preview-wrapper">
                    <div class="product-preview open">
                        <div class="product-preview__image">
                            <a href="product.html">
                                <img src="images/product-empty.png" data-lazy="images/4-blue.JPG" alt=""/>
                            </a>
                        </div>
                        <div class="product-preview__info text-center">
                            <div class="product-preview__info__btns"><a href="#"
                                                                        class="btn btn--round ajax-to-cart"><span
                                            class="icon-ecommerce"></span></a></div>
                            <div class="product-preview__info__title">
                                <h2><a href="#">Пальто демисезонное</a></h2>
                            </div>
                            <div class="price-box">5 000 руб.</div>
                            <div class="product-preview__info__description">
                                <p>Nulla at mauris leo. Donec quis ex elementum, tincidunt elit quis, cursus tortor.
                                    Sed sollicitudin enim metus, ut hendrerit orci dignissim venenatis.</p>
                                <p>Suspendisse consectetur odio diam, ut consequat quam aliquet at.</p>
                            </div>
                            <div class="product-preview__info__link">
                                <a href="#" class="ajax-to-wishlist"><span class="icon icon-favorite"></span><span
                                            class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span></a><a
                                        href="#" class="btn btn--wd buy-link"><span
                                            class="icon icon-ecommerce"></span><span
                                            class="product-preview__info__link__text">Добавить в корзину</span></a></div>
                        </div>
                    </div>
                </div>
                <div class="product-preview-wrapper">
                    <div class="product-preview open">
                        <div class="product-preview__image"><a href="product.html"><img
                                        src="images/product-empty.png" data-lazy="images/2-black.JPG"
                                        alt=""/></a></div>
                        <div class="product-preview__info text-center">
                            <div class="product-preview__info__btns"><a href="#"
                                                                        class="btn btn--round ajax-to-cart"><span
                                            class="icon-ecommerce"></span></a></div>
                            <div class="product-preview__info__title">
                                <h2><a href="product.html">Пальто демисезонное</a></h2>
                            </div>
                            <div class="price-box">5 000 руб.</div>
                            <div class="product-preview__info__description">
                                <p>Nulla at mauris leo. Donec quis ex elementum, tincidunt elit quis, cursus tortor.
                                    Sed sollicitudin enim metus, ut hendrerit orci dignissim venenatis.</p>
                                <p>Suspendisse consectetur odio diam, ut consequat quam aliquet at.</p>
                            </div>
                            <div class="product-preview__info__link">
                                <a href="#" class="ajax-to-wishlist"><span class="icon icon-favorite"></span><span
                                            class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span></a><a
                                        href="#" class="btn btn--wd buy-link"><span
                                            class="icon icon-ecommerce"></span><span
                                            class="product-preview__info__link__text">Добавить в корзину</span></a></div>
                        </div>
                    </div>
                </div>
                <div class="product-preview-wrapper">
                    <div class="product-preview open">
                        <div class="product-preview__image"><a href="product.html"><img
                                        src="images/product-empty.png" data-lazy="images/7-sky-blue.JPG"
                                        alt=""/></a></div>
                        <div class="product-preview__info text-center">
                            <div class="product-preview__info__btns"><a href="#"
                                                                        class="btn btn--round ajax-to-cart"><span
                                            class="icon-ecommerce"></span></a></div>
                            <div class="product-preview__info__title">
                                <h2><a href="product.html">Пальто демисезонное</a></h2>
                            </div>
                            <div class="price-box">5 000 руб.</div>
                            <div class="product-preview__info__description">
                                <p>Nulla at mauris leo. Donec quis ex elementum, tincidunt elit quis, cursus tortor.
                                    Sed sollicitudin enim metus, ut hendrerit orci dignissim venenatis.</p>
                                <p>Suspendisse consectetur odio diam, ut consequat quam aliquet at.</p>
                            </div>
                            <div class="product-preview__info__link">
                                <a href="#" class="ajax-to-wishlist"><span class="icon icon-favorite"></span><span
                                            class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span></a><a
                                        href="#" class="btn btn--wd buy-link"><span
                                            class="icon icon-ecommerce"></span><span
                                            class="product-preview__info__link__text">Добавить в корзину</span></a></div>
                        </div>
                    </div>
                </div>
                <div class="product-preview-wrapper">
                    <div class="product-preview open">
                        <div class="product-preview__image">
                            <a href="product.html">
                                <img src="images/1-yellow.JPG" data-lazy="images/1-yellow.JPG" alt=""/>
                            </a>
                        </div>
                        <div class="product-preview__info text-center">
                            <div class="product-preview__info__btns">
                                <a href="#" class="btn btn--round ajax-to-cart">
                                    <span class="icon-ecommerce"></span>
                                </a>
                            </div>
                            <div class="product-preview__info__title">
                                <h2><a href="product.html">Пальто демисезонное</a></h2>
                            </div>
                            <ul class="options-swatch options-swatch--color">
                                <li>
                                    <a href="#">
                                            <span class="swatch-label">
                                                <img src="images/colors/blue.png" width="10" height="10" alt=""/>
                                            </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                            <span class="swatch-label">
                                                <img src="images/colors/yellow.png" width="10" height="10" alt=""/>
                                            </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                            <span class="swatch-label">
                                                <img src="images/colors/green.png" width="10" height="10" alt=""/>
                                            </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                            <span class="swatch-label">
                                                <img src="images/colors/dark-grey.png" width="10" height="10" alt=""/>
                                            </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                            <span class="swatch-label">
                                                <img src="images/colors/grey.png" width="10" height="10" alt=""/>
                                            </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                            <span class="swatch-label">
                                                <img src="images/colors/red.png" width="10" height="10" alt=""/>
                                            </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                            <span class="swatch-label">
                                                <img src="images/colors/white.png" width="10" height="10" alt=""/>
                                            </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="price-box">
                                <span class="price-box__new">5 000 руб.</span>
                                <span class="price-box__old">7 000 руб.</span>
                            </div>
                            <div class="product-preview__info__description">
                                <p>Nulla at mauris leo. Donec quis ex elementum, tincidunt elit quis, cursus tortor.
                                    Sed sollicitudin enim metus, ut hendrerit orci dignissim venenatis.</p>
                                <p>Suspendisse consectetur odio diam, ut consequat quam aliquet at.</p>
                            </div>
                            <div class="product-preview__info__link">
                                <a href="#" class="ajax-to-wishlist">
                                    <span class="icon icon-favorite"></span>
                                        <span class="product-preview__info__link__text dashed-bottom">
                                            Добавить в список желаний
                                        </span>
                                </a>
                                <a href="#" class="btn btn--wd buy-link">
                                    <span class="icon icon-ecommerce"></span>
                                        <span class="product-preview__info__link__text">
                                            Добавить в корзину
                                        </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Content section -->
@endsection