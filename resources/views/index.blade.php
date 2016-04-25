@extends('layouts.main')

@section('content')

{!! $slider->show() !!}

<!-- 12 items -->
<section class="content">
    <div class="container">
        <h2 class="text-center text-uppercase">Лидеры продаж</h2>

        <div class="products-grid products-listing products-col four-in-row">
            @foreach($bestSellers as $bestSeller)
                <div class="product-preview-wrapper">
                    <div class="product-preview open">
                        <div class="product-preview__image">
                            <a href="{{ route('product.productInfo', ['alias' => $bestSeller->alias]) }}">
                                <img src="{{ $bestSeller->getImageUrl() }}" alt=""/>
                            </a>
                            {{--<div class="product-preview__label product-preview__label--left product-preview__label--new">--}}
                                {{--<span>новое</span>--}}
                            {{--</div>--}}
                            {{--<div class="product-preview__label product-preview__label--right product-preview__label--sale">--}}
                                {{--<span>скидка<br>-10%</span>--}}
                            {{--</div>--}}
                            {{--<div class="countdown_box">--}}
                                {{--<div class="countdown_inner">--}}
                                    {{--<div class="title">специальная цена:</div>--}}
                                    {{--<div id="countdown3"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="product-preview__info text-center">
                            <div class="product-preview__info__btns">
                                <a href="#" class="btn btn--round">
                                    <span class="icon-ecommerce"></span>
                                </a>
                            </div>
                            <div class="product-preview__info__title">
                                <h2>
                                    <a href="{{ route('product.productInfo', ['alias' => $bestSeller->alias]) }}">
                                        {{ $bestSeller->title }}
                                    </a>
                                </h2>
                            </div>
                            {{--<ul class="options-swatch options-swatch--color">--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<span class="swatch-label">--}}
                                            {{--<img src="images/colors/blue.png" width="10" height="10" alt=""/>--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<span class="swatch-label">--}}
                                            {{--<img src="images/colors/yellow.png" width="10" height="10" alt=""/>--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<span class="swatch-label">--}}
                                            {{--<img src="images/colors/green.png" width="10" height="10" alt=""/>--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<span class="swatch-label">--}}
                                            {{--<img src="images/colors/dark-grey.png" width="10" height="10" alt=""/>--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<span class="swatch-label">--}}
                                            {{--<img src="images/colors/grey.png" width="10" height="10" alt=""/>--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<span class="swatch-label">--}}
                                            {{--<img src="images/colors/red.png" width="10" height="10" alt=""/>--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<span class="swatch-label">--}}
                                            {{--<img src="images/colors/white.png" width="10" height="10" alt=""/>--}}
                                        {{--</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            <div class="price-box ">
                                <span class="price-box__new">{{ \App\Helpers\Str::priceFormat($bestSeller->price) }}</span>
                                {{--<span class="price-box__old">6000 руб.</span>--}}
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
            @endforeach
        </div>
    </div>
</section>

<!-- Content section -->
<section class="content">
    <div class="container">
        <h2 class="text-uppercase">{{ $page->title }}</h2>

        {!! $page->content !!}
    </div>
</section>

<!-- Carousel section -->
<section class="content">
    <div class="container">
        <h2 class="text-center text-uppercase">Распродажа</h2>
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
                                        <span class="product-preview__info__link__text dashed-bottom">
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

<!-- Brands Section -->
<section class="content content--fill top-null">
    <div class="container">
        <h2 class="text-center text-uppercase">С нами сотрудничают</h2>
        <div class="brands brands-carousel animated-arrows mobile-special-arrows">
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-01.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-02.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-03.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-04.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-05.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-06.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-07.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-01.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-02.png" alt=""/></a></div>
            <div class="brands__item"><a href="#"><img src="images/brand-empty.png"
                                                       data-lazy="images/brand-03.png" alt=""/></a></div>
        </div>
    </div>
</section>
<!-- End Brands Section -->

<!-- Reviews Section -->
<section class="content">
    <div class="container">
        <div class="row staggered-animation-container">
            <h2 class="text-center text-uppercase">Отзывы</h2>
            <div class="testimonials">
                <div class="col-sm-6 col-md-3 animation" data-animation="fadeInUp" data-animation-delay="0.1s">
                    <div class="testimonials__item">
                        <div class="testimonials__item__image-sell">
                            <a href="#">
                                <img src="images/blog-author-img-04.jpg" alt=""/>
                            </a>
                            <div class="testimonials__item__image-sell__author text-uppercase">
                                Алина
                            </div>
                        </div>
                        <div class="testimonials__item__text">
                            <em>Далеко-далеко за словесными горами в стране
                                гласных и согласных живут рыбные тексты. Вдали от всех живут
                                они в буквенных домах на берегу Семантика большого языкового океана.
                                Маленький ручеек Даль журчит по всей стране.</em>
                        </div>
                    </div>
                </div>
                <div class="divider divider--sm visible-xs"></div>
                <div class="col-sm-6 col-md-3 animation" data-animation="fadeInUp" data-animation-delay="0.2s">
                    <div class="testimonials__item">
                        <div class="testimonials__item__image-sell">
                            <a href="#">
                                <img src="images/testimonials-author-img-01.jpg" alt=""/>
                            </a>
                            <div class="testimonials__item__image-sell__author text-uppercase">
                                Дмитрий Сергеевич
                            </div>
                        </div>
                        <div class="testimonials__item__text">
                            <em>Эта парадигматическая страна, в которой жаренные члены предложения
                                залетают прямо в рот. Даже всемогущая пунктуация не имеет власти
                                над рыбными текстами.
                                Однажды одна маленькая строчка рыбного текста
                                решила выйти в большой мир грамматики.</em>
                        </div>
                    </div>
                </div>
                <div class="divider divider--sm visible-xs visible-sm"></div>
                <div class="col-sm-6 col-md-3 animation" data-animation="fadeInUp" data-animation-delay="0.3s">
                    <div class="testimonials__item">
                        <div class="testimonials__item__image-sell">
                            <a href="#">
                                <img src="images/blog-author-img-02.jpg" alt=""/>
                            </a>
                            <div class="testimonials__item__image-sell__author text-uppercase">
                                Ольга П.
                            </div>
                        </div>
                        <div class="testimonials__item__text">
                            <em>Маленький ручеек Даль журчит по всей стране и обеспечивает
                                ее всеми необходимыми правилами. Эта парадигматическая страна,
                                в которой жаренные члены предложения залетают прямо в рот.</em>
                        </div>
                    </div>
                </div>
                <div class="divider divider--sm visible-xs"></div>
                <div class="col-sm-6 col-md-3 animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                    <div class="testimonials__item">
                        <div class="testimonials__item__image-sell">
                            <a href="#">
                                <img src="images/blog-author-img-01.jpg" alt=""/>
                            </a>
                            <div class="testimonials__item__image-sell__author text-uppercase">
                                Руслан
                            </div>
                        </div>
                        <div class="testimonials__item__text">
                            <em>Даже всемогущая пунктуация не имеет власти над рыбными
                                текстами, ведущими безорфографичный образ жизни.
                                Однажды одна маленькая строчка рыбного текста по
                                имени Lorem ipsum решила выйти в большой мир грамматики.</em>
                        </div>
                    </div>
                </div>
                <div class="divider divider--sm visible-xs visible-sm"></div>
            </div>

            <!--<div class="col-sm-6 col-md-3 animation" data-animation="fadeInUp" data-animation-delay="0.1s">-->
            <!--<h4 class="text-uppercase">Новые поступления</h4>-->
            <!--<div class="text-center">-->
            <!--<div class="banner banner&#45;&#45;image hover-squared"><a href="listing-open-filter.html"><img-->
            <!--src="images/banner-small-01.jpg" class="img-responsive" alt=""/></a>-->
            <!--<div class="product-category__hover caption"></div>-->
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="divider divider&#45;&#45;sm visible-xs"></div>-->
            <!--<div class="col-sm-6 col-md-3 animation" data-animation="fadeInUp" data-animation-delay="0.2s">-->
            <!--<h4 class="text-uppercase">Отзывы</h4>-->
            <!--<div class="testimonials">-->
            <!--<div class="testimonials-carousel nav-dot">-->
            <!--<div class="testimonials__item">-->
            <!--<div class="testimonials__item__image-sell">-->
            <!--<a href="#">-->
            <!--<img src="images/testimonials-author-img-01.jpg" alt=""/>-->
            <!--</a>-->
            <!--<div class="testimonials__item__image-sell__author text-uppercase">-->
            <!--Пол Грант-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="testimonials__item__text">-->
            <!--<em>Далеко-далеко за словесными горами в стране-->
            <!--гласных и согласных живут рыбные тексты. Вдали от всех живут-->
            <!--они в буквенных домах на берегу Семантика большого языкового океана.-->
            <!--Маленький ручеек Даль журчит по всей стране.</em>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="testimonials__item">-->
            <!--<div class="testimonials__item__image-sell">-->
            <!--<a href="#">-->
            <!--<img src="images/testimonials-author-img-01.jpg" alt=""/>-->
            <!--</a>-->
            <!--<div class="testimonials__item__image-sell__author text-uppercase">-->
            <!--Пол Грант-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="testimonials__item__text">-->
            <!--<em>Эта парадигматическая страна, в которой жаренные члены предложения-->
            <!--залетают прямо в рот. Даже всемогущая пунктуация не имеет власти-->
            <!--над рыбными текстами.-->
            <!--Однажды одна маленькая строчка рыбного текста-->
            <!--решила выйти в большой мир грамматики.</em>-->
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="divider divider&#45;&#45;sm visible-sm visible-xs"></div>-->
            <!--<div class="col-sm-6 col-md-3 animation" data-animation="fadeInUp" data-animation-delay="0.3s">-->
            <!--<h4 class="text-uppercase">Новинки</h4>-->
            <!--<div class="products-widget card">-->
            <!--<div class="products-widget-carousel nav-dot">-->
            <!--<div class="products-widget__item">-->
            <!--<div class="products-widget__item__image pull-left">-->
            <!--<a href="product.html">-->
            <!--<img src="images/1-yellow.JPG" alt=""/>-->
            <!--</a>-->
            <!--</div>-->
            <!--<div class="products-widget__item__info">-->
            <!--<div class="products-widget__item__info__title">-->
            <!--<h2 class="text-uppercase"><a href="product.html">Пальто демисезонное</a></h2>-->
            <!--</div>-->
            <!--<div class="price-box">5 000 руб.</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="products-widget__item">-->
            <!--<div class="products-widget__item__image pull-left"><a href="product.html"><img-->
            <!--src="images/5-red.JPG" alt=""/></a></div>-->
            <!--<div class="products-widget__item__info">-->
            <!--<div class="products-widget__item__info__title">-->
            <!--<h2 class="text-uppercase"><a href="product.html">Пальто демисезонное</a></h2>-->
            <!--</div>-->
            <!--<div class="price-box">5 000 руб.</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="products-widget__item">-->
            <!--<div class="products-widget__item__image pull-left"><a href="product.html"><img-->
            <!--src="images/1-yellow-blond.JPG" alt=""/></a></div>-->
            <!--<div class="products-widget__item__info">-->
            <!--<div class="products-widget__item__info__title">-->
            <!--<h2 class="text-uppercase"><a href="product.html">Пальто демисезонное</a></h2>-->
            <!--</div>-->
            <!--<div class="price-box">5 000 руб.</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="products-widget__item">-->
            <!--<div class="products-widget__item__image pull-left"><a href="product.html"><img-->
            <!--src="images/2-black.JPG" alt=""/></a></div>-->
            <!--<div class="products-widget__item__info">-->
            <!--<div class="products-widget__item__info__title">-->
            <!--<h2 class="text-uppercase"><a href="product.html">Пальто демисезонное</a></h2>-->
            <!--</div>-->
            <!--<div class="price-box">5 000 руб.</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="products-widget__item">-->
            <!--<div class="products-widget__item__image pull-left"><a href="product.html"><img-->
            <!--src="images/8-pink.JPG" alt=""/></a></div>-->
            <!--<div class="products-widget__item__info">-->
            <!--<div class="products-widget__item__info__title">-->
            <!--<h2 class="text-uppercase"><a href="product.html">Пальто демисезонное</a></h2>-->
            <!--</div>-->
            <!--<div class="price-box">5 000 руб.</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="divider divider&#45;&#45;sm visible-xs"></div>-->
            <!--<div class="col-sm-6 col-md-3 animation" data-animation="fadeInUp" data-animation-delay="0.4s">-->
            <!--<h4 class="text-uppercase">Скидки</h4>-->
            <!--<div class="products-widget card">-->
            <!--<div class="products-widget-carousel nav-dot">-->
            <!--<div class="products-widget__item">-->
            <!--<div class="products-widget__item__image pull-left"><a href="product.html"><img-->
            <!--src="images/3-gray-blue.JPG" alt=""/></a></div>-->
            <!--<div class="products-widget__item__info">-->
            <!--<div class="products-widget__item__info__title">-->
            <!--<h2 class="text-uppercase"><a href="product.html">Пальто демисезонное</a></h2>-->
            <!--</div>-->
            <!--<div class="price-box"><span class="price-box__new">5 000 руб.</span> <span-->
            <!--class="price-box__old">7 000 руб.</span></div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="products-widget__item">-->
            <!--<div class="products-widget__item__image pull-left"><a href="product.html"><img-->
            <!--src="images/7-sky-blue.JPG" alt=""/></a></div>-->
            <!--<div class="products-widget__item__info">-->
            <!--<div class="products-widget__item__info__title">-->
            <!--<h2 class="text-uppercase"><a href="product.html">Пальто демисезонное</a></h2>-->
            <!--</div>-->
            <!--<div class="price-box"><span class="price-box__new">5 000 руб.</span> <span-->
            <!--class="price-box__old">7 000 руб.</span></div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="products-widget__item">-->
            <!--<div class="products-widget__item__image pull-left"><a href="product.html"><img-->
            <!--src="images/2-black.JPG" alt=""/></a></div>-->
            <!--<div class="products-widget__item__info">-->
            <!--<div class="products-widget__item__info__title">-->
            <!--<h2 class="text-uppercase"><a href="product.html">Пальто демисезонное</a></h2>-->
            <!--</div>-->
            <!--<div class="price-box"><span class="price-box__new">5 000 руб.</span> <span-->
            <!--class="price-box__old">7 000 руб.</span></div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="products-widget__item">-->
            <!--<div class="products-widget__item__image pull-left"><a href="product.html"><img-->
            <!--src="images/5-red.JPG" alt=""/></a></div>-->
            <!--<div class="products-widget__item__info">-->
            <!--<div class="products-widget__item__info__title">-->
            <!--<h2 class="text-uppercase"><a href="product.html">Пальто демисезонное</a></h2>-->
            <!--</div>-->
            <!--<div class="price-box"><span class="price-box__new">5 000 руб.</span> <span-->
            <!--class="price-box__old">7 000 руб.</span></div>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="products-widget__item">-->
            <!--<div class="products-widget__item__image pull-left"><a href="product.html"><img-->
            <!--src="images/8-pink.JPG" alt=""/></a></div>-->
            <!--<div class="products-widget__item__info">-->
            <!--<div class="products-widget__item__info__title">-->
            <!--<h2 class="text-uppercase"><a href="product.html">Пальто демисезонное</a></h2>-->
            <!--</div>-->
            <!--<div class="price-box"><span class="price-box__new">5 000 руб.</span> <span-->
            <!--class="price-box__old">7 000 руб.</span></div>-->
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->
        </div>
    </div>
</section>
<!-- End Content section -->
@endsection
