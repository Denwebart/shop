@extends('layouts.main')

@section('content')
    <!-- Breadcrumb section -->
    <section class="breadcrumbs  hidden-xs">
        <div class="container">
            @include('parts.breadcrumbs')
        </div>
    </section>

    <!-- Content section -->
    @if($page->title || $page->introtext)
        <section class="content">
            <div class="container">
                @if($page->title)
                    <h2 class="category-outer__text__title text-uppercase">{{ $page->title }}</h2>
                @endif
                @if($page->introtext)
                    {!! $page->introtext !!}
                @endif
            </div>
        </section>
    @endif

    <section class="content">
        <div class="container">
            <div class="filters-row row">
                <div class="col-sm-4 col-md-4 col-lg-3 col-1">
                    <a class="filters-row__view active link-grid-view icon icon-keyboard"></a>
                    <a class="filters-row__view link-row-view icon icon-list"></a>
                    <a class="btn btn--wd btn--with-icon btn--sm wave" id="showFilter">
                        <span class="icon icon-filter"></span>
                        Фильтры
                    </a>
                    <a class="btn btn--wd btn--with-icon btn--sm wave" id="showFilterMobile">
                        <span class="icon icon-filter"></span>
                        Фильтры
                    </a>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-9 col-2">
                    <div class="filters-row__items">Показано 12 из 55</div>

                    <div class="hidden-lg hidden-md hidden-xs divider divider--sm--10"></div>

                    <div class="filters-row__select">
                        <label>На странице: </label>
                        <select class="selectpicker" data-style="select--wd select--wd--sm" data-width="60">
                            <option>12</option>
                            <option>24</option>
                            <option>36</option>
                        </select>
                    </div>
                    <div class="filters-row__select">
                        <label>Сортировать по: </label>
                        <select class="selectpicker" data-style="select--wd select--wd--sm" data-width="130">
                            <option>дате</option>
                            <option>цене</option>
                            <option>рейтингу</option>
                        </select>
                        <a href="#" class="icon icon-arrow-down active"></a>
                        <a href="#" class="icon icon-arrow-up"></a>
                    </div>
                </div>
            </div>
            <div class="outer open">
                <div id="leftCol">
                    <div id="filtersCol" class="filters-col">
                        <div class="filters-col__close" id="filtersColClose">
                            <a href="#" class="icon icon-clear"></a>
                        </div>
                        <div class="filters-col__select visible-xs">
                            <label>На странице: </label>
                            <select class="selectpicker" data-style="select--wd select--wd--sm" data-width="60">
                                <option>12</option>
                                <option>24</option>
                                <option>36</option>
                            </select>
                        </div>
                        <div class="filters-col__select visible-xs">
                            <label>Сортировать по: </label>
                            <select class="selectpicker" data-style="select--wd select--wd--sm" data-width="100">
                                <option>дате</option>
                                <option>цене</option>
                                <option>рейтингу</option>
                            </select>
                        </div>
                        <div class="filters-col__collapse open">
                            <h4 class="filters-col__collapse__title text-uppercase">Категория</h4>
                            <div class="filters-col__collapse__content">
                                <ul class="filter-list">
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox21">
                                        <label for="checkBox1">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            Пальто (22)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox22">
                                        <label for="checkBox2">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            Плащи (18)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox23">
                                        <label for="checkBox3">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            Куртки (11)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox25">
                                        <label for="checkBox5">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            Шубы (12)
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filters-col__collapse open">
                            <h4 class="filters-col__collapse__title text-uppercase">Бренд</h4>
                            <div class="filters-col__collapse__content">
                                <ul class="filter-list">
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox1">
                                        <label for="checkBox1">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            Mango (2)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox2">
                                        <label for="checkBox2">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            Vero Moda (8)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox3">
                                        <label for="checkBox3">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            H.E. by Mango (11)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox5">
                                        <label for="checkBox5">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            Gant (12)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox6">
                                        <label for="checkBox6">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            L.B.D (2)
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filters-col__collapse open">
                            <h4 class="filters-col__collapse__title text-uppercase">Цена</h4>
                            <div class="filters-col__collapse__content">
                                <ul class="filter-list">
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox7">
                                        <label for="checkBox7">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            0 руб. - 10 000 руб.
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox8">
                                        <label for="checkBox8">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            10 000 руб. - 20 000 руб.
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filters-col__collapse open">
                            <h4 class="filters-col__collapse__title text-uppercase">Цена</h4>
                            <div class="filters-col__collapse__content">
                                <div id="priceSlider" class="price-slider"></div>
                            </div>
                        </div>
                        <div class="filters-col__collapse open">
                            <h4 class="filters-col__collapse__title text-uppercase">Цвет</h4>
                            <div class="filters-col__collapse__content">
                                <ul class="filter-list">
                                    <li>
                                        <a href="#">
                                            <span class="color-icon">
                                                <img src="/images/colors/blue.png" alt=""/>
                                            </span>
                                            Синий (9)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="color-icon">
                                                <img src="/images/colors/red.png" alt=""/>
                                            </span>
                                            Красный (2)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="color-icon">
                                                <img src="/images/colors/yellow.png" alt=""/>
                                            </span>
                                            Желтый (7)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="color-icon">
                                                <img src="/images/colors/grey.png" alt=""/>
                                            </span>
                                            Серый (1)
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filters-col__collapse open">
                            <h4 class="filters-col__collapse__title text-uppercase">Размер</h4>
                            <div class="filters-col__collapse__content">
                                <ul class="filter-list">
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox13">
                                        <label for="checkBox13">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            42 (XS) (1)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox14">
                                        <label for="checkBox14">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            44 (S) (4)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox15">
                                        <label for="checkBox15">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            46 (M) (6)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox16">
                                        <label for="checkBox16">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            48 (L) (3)
                                        </label>
                                    </li>
                                    <li class="checkbox-group">
                                        <input type="checkbox" id="checkBox17">
                                        <label for="checkBox17">
                                            <span class="check"></span>
                                            <span class="box"></span>
                                            50 (XL) (5)
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filters-col__collapse open">
                            <h4 class="filters-col__collapse__title text-uppercase">Теги</h4>
                            <div class="filters-col__collapse__content">
                                <ul class="tags-list">
                                    <li><a href="#">Новое</a></li>
                                    <li><a href="#">Рекомендуем</a></li>
                                    <li><a href="#">Акция</a></li>
                                    <li><a href="#">Распродажа</a></li>
                                    <li><a href="#">Скидки</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="centerCol">
                    <div class="products-grid products-listing products-col products-isotope four-in-row">
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/8-pink.JPG" alt=""/>
                                    </a>
                                    <div class="product-preview__label product-preview__label--left product-preview__label--new">
                                        <span>новое</span>
                                    </div>
                                    <div class="product-preview__label product-preview__label--right product-preview__label--sale">
                                        <span>скидка<br>-10%</span>
                                    </div>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <ul class="options-swatch options-swatch--color">
                                        <li>
                                            <a href="#"><span class="swatch-label">
                                                <img src="/images/colors/blue.png" width="10" height="10" alt=""/></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="swatch-label">
                                                <img src="/images/colors/yellow.png" width="10" height="10" alt=""/></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="swatch-label">
                                                    <img src="/images/colors/green.png" width="10" height="10" alt=""/>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="swatch-label">
                                                <img src="/images/colors/dark-grey.png" width="10" height="10" alt=""/></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><span class="swatch-label">
                                                <img src="/images/colors/grey.png" width="10" height="10" alt=""/></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="swatch-label">
                                                    <img src="/images/colors/red.png" width="10" height="10" alt=""/>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="swatch-label">
                                                    <img src="/images/colors/white.png" width="10" height="10" alt=""/>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="price-box ">
                                        <span class="price-box__new">5400 руб.</span>
                                        <span class="price-box__old">6000 руб.</span>
                                    </div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html"><img src="/images/2-black.JPG" alt=""/></a>
                                    <div class="countdown_box">
                                        <div class="countdown_inner">
                                            <div class="title">специальная цена:</div>
                                            <div id="countdown1"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
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
                                                    <img src="/images/colors/blue.png" width="10" height="10" alt=""/></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="swatch-label">
                                                    <img src="/images/colors/yellow.png" width="10" height="10" alt=""/></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="swatch-label">
                                                    <img src="/images/colors/green.png" width="10" height="10" alt=""/>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="swatch-label">
                                                    <img src="/images/colors/dark-grey.png" width="10" height="10" alt=""/>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="swatch-label">
                                                    <img src="/images/colors/grey.png" width="10" height="10" alt=""/>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="swatch-label">
                                                    <img src="/images/colors/red.png" width="10" height="10" alt=""/>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="swatch-label">
                                                    <img src="/images/colors/white.png" width="10" height="10" alt=""/>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="price-box">
                                        <span class="price-box__new">5000 руб.</span>
                                        <span class="price-box__old">7000 руб.</span>
                                    </div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#"><span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/7-sky-blue.JPG" alt=""/>
                                    </a>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <div class="price-box">6000 руб.</div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/5-red.JPG" alt=""/>
                                    </a>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <div class="price-box">6000 руб.</div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/1-yellow-blond.JPG" alt=""/>
                                    </a>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <div class="price-box">6000 руб.</div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/8-pink.JPG" alt=""/>
                                    </a>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <div class="price-box">6000 руб.</div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/1-yellow.JPG" alt=""/>
                                    </a>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <div class="price-box">6000 руб.</div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/6-green.JPG" alt=""/>
                                    </a>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <div class="price-box">6000 руб.</div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/3-gray-blue.JPG" alt=""/>
                                    </a>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <div class="price-box">6000 руб.</div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/2-black.JPG" alt=""/>
                                    </a>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <div class="price-box">6000 руб.</div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/5-red.JPG" alt=""/>
                                    </a>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <div class="price-box">6000 руб.</div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-preview-wrapper">
                            <div class="product-preview open">
                                <div class="product-preview__image">
                                    <a href="product.html">
                                        <img src="/images/1-yellow-blond.JPG" alt=""/>
                                    </a>
                                </div>
                                <div class="product-preview__info text-center">
                                    <div class="product-preview__info__btns">
                                        <a href="#" class="btn btn--round">
                                            <span class="icon-ecommerce"></span>
                                        </a>
                                    </div>
                                    <div class="product-preview__info__title">
                                        <h2><a href="product.html">Пальто демисезонное</a></h2>
                                    </div>
                                    <div class="price-box">6000 руб.</div>
                                    <div class="product-preview__info__description">
                                        <p>Далеко-далеко за словесными горами в стране гласных
                                            и согласных живут рыбные тексты. Вдали от всех
                                            живут они в буквенных домах на берегу Семантика
                                            большого языкового океана.</p>
                                        <p>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                            ее всеми необходимыми правилами.</p>
                                    </div>
                                    <div class="product-preview__info__link">
                                        <a href="#">
                                            <span class="icon icon-favorite"></span>
                                            <span class="product-preview__info__link__text dashed-bottom">Добавить в список желаний</span>
                                        </a>
                                        <a href="#" class="btn btn--wd buy-link">
                                            <span class="icon icon-ecommerce"></span>
                                            <span class="product-preview__info__link__text">Добавить в корзину</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <ul class="pagination">
                    <li><a href="#">«</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Content section -->
    @if($page->content)
        <section class="content">
            <div class="container">
                {!! $page->content !!}
            </div>
        </section>
    @endif
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/nouislider/nouislider.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/elevatezoom/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
@endpush