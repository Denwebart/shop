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
            {!! Form::open(['url' => Request::getUri(), 'id' => 'filters-form']) !!}
            <div class="filters-row row">
                <div class="col-sm-4 col-md-4 col-lg-3 col-1">
                    <a class="filters-row__view link-grid-view icon icon-keyboard @if(\Request::cookie('catalog-view', 'grid') == 'grid') active @endif"></a>
                    <a class="filters-row__view link-row-view icon icon-list @if(\Request::cookie('catalog-view', 'list') == 'row') active @endif"></a>
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
                    <div class="filters-row__items count-container">
                        @include('parts.count', ['models' => $products])
                    </div>

                    <div class="hidden-lg hidden-md hidden-xs divider divider--sm--10"></div>

                    <div class="filters-row__select">
                        <label>На странице: </label>
                        <select class="selectpicker ajax-sort onpage" name="onpage" data-style="select--wd select--wd--sm" data-width="60">
                            <option value="12" @if(\Request::get('onpage') == '12' || \Request::cookie('catalog-onpage', 12) == '12') selected @endif>12</option>
                            <option value="24" @if(\Request::get('onpage') == '24' || \Request::cookie('catalog-onpage', 12) == '24') selected @endif>24</option>
                            <option value="36" @if(\Request::get('onpage') == '36' || \Request::cookie('catalog-onpage', 12) == '36') selected @endif>36</option>
                        </select>
                    </div>
                    <div class="filters-row__select">
                        <label>Сортировать по: </label>
                        <select class="selectpicker ajax-sort sortby" name="sortby" data-style="select--wd select--wd--sm" data-width="130">
                            <option value="published_at" @if(\Request::get('sortby') == 'published_at') selected @endif>дате</option>
                            <option value="price" @if(\Request::get('sortby') == 'price') selected @endif>цене</option>
                            <option value="rating" @if(\Request::get('sortby') == 'rating') selected @endif>рейтингу</option>
                            <option value="popular" @if(\Request::get('sortby') == 'popular' || !\Request::has('sortby')) selected @endif>популярности</option>
                        </select>
                        <a href="javascript:void(0)" class="icon icon-arrow-down m-l-10 active sort-direction" data-value="desc" rel="nofollow" title="По убыванию" data-toggle="tooltip"></a>
                        <a href="javascript:void(0)" class="icon icon-arrow-up sort-direction" data-value="asc" rel="nofollow" title="По возростанию" data-toggle="tooltip"></a>
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
                            <select class="selectpicker ajax-sort onpage" name="onpage" data-style="select--wd select--wd--sm" data-width="60">
                                <option value="12" @if(\Request::get('onpage') == '12' || \Request::cookie('catalog-onpage', 12) == '12') selected @endif>12</option>
                                <option value="24" @if(\Request::get('onpage') == '24' || \Request::cookie('catalog-onpage', 12) == '24') selected @endif>24</option>
                                <option value="36" @if(\Request::get('onpage') == '36' || \Request::cookie('catalog-onpage', 12) == '36') selected @endif>36</option>
                            </select>
                        </div>
                        <div class="filters-col__select visible-xs">
                            <label>Сортировать по: </label>
                            <select class="selectpicker ajax-sort sortby" name="sortby" data-style="select--wd select--wd--sm" data-width="130">
                                <option value="published_at" @if(\Request::get('sortby') == 'published_at') selected @endif>дате</option>
                                <option value="price" @if(\Request::get('sortby') == 'price') selected @endif>цене</option>
                                <option value="rating" @if(\Request::get('sortby') == 'rating') selected @endif>рейтингу</option>
                                <option value="popular" @if(\Request::get('sortby') == 'popular' || !\Request::has('sortby')) selected @endif>популярности</option>
                            </select>
                            <a href="javascript:void(0)" class="icon icon-arrow-down m-l-10 active sort-direction" data-value="desc" rel="nofollow" title="По убыванию" data-toggle="tooltip"></a>
                            <a href="javascript:void(0)" class="icon icon-arrow-up sort-direction" data-value="asc" rel="nofollow" title="По возростанию" data-toggle="tooltip"></a>
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
                <div id="centerCol" class="products-container">
                    @include('parts.productsList')
                </div>
            </div>
            {!! Form::close() !!}
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

    <script type="text/javascript">

        //Isotope
        jQuery(function($j) {

            "use strict";

            var windowW = window.innerWidth || $(window).width();

            if ($j('.products-isotope').length){
                $j('.products-isotope').imagesLoaded(function() {

                    $j('.products-isotope').isotope({
                        itemSelector: '.product-preview-wrapper',
                        layoutMode: 'fitRows'
                    })

                });
            }


            var minW =  parseInt($j('.products-col').find('.product-preview-wrapper:first-child').width());
            if ($j('.products-isotope').hasClass('two-in-row')){
                minW = minW-200;
            }

            if ($j('.products-col').parent().parent().hasClass('open')) {

                if ( $j('html').css('direction').toLowerCase() == 'rtl' ) {
                    $j('.products-col').stop(true,false).animate({marginRight: '280px'}, 200,
                            function() {
                                setProductSize($j('.products-col'),minW);
                                $j('.products-isotope').isotope().isotope('layout');
                            });

                }
                else {
                    $j('.products-col').stop(true,false).animate({marginLeft: '280px'}, 200,
                            function() {
                                setProductSize($j('.products-col'),minW);
                                $j('.products-isotope').isotope().isotope('layout');
                            });
                }
            }



            $j('#showFilter').click(function(e) {
                e.preventDefault();

                var minW =  parseInt($j('.products-col').find('.product-preview-wrapper:first-child').width());
                if ($j('.products-isotope').hasClass('two-in-row')){
                    minW = minW-200;
                }
                if (!$j('.products-col').parent().parent().hasClass('open')) {
                    $j('.products-col').parent().parent().addClass('open');
                    if ( $j('html').css('direction').toLowerCase() == 'rtl' ) {
                        $j('.products-col').stop(true,false).animate({marginRight: '280px'}, 200,
                                function() {
                                    setProductSize($j('.products-col'),minW);
                                    $j('.products-isotope').isotope().isotope('layout');
                                });

                    }
                    else {
                        $j('.products-col').stop(true,false).animate({marginLeft: '280px'}, 200,
                                function() {
                                    setProductSize($j('.products-col'),minW);
                                    $j('.products-isotope').isotope().isotope('layout');
                                });
                    }
                }
                else {
                    $j('.products-col').parent().parent().removeClass('open');

                    $j('.products-col').stop(true,false).animate({marginLeft: '0', marginRight: '0'}, 200,
                            function() {

                                if ($j('.products-isotope').hasClass('two-in-row')){
                                    if (windowW > 560) {
                                        minW = $j('.products-isotope').width()/2;
                                    } else {
                                        minW = $j('.products-isotope').width()/1;
                                    }
                                } else if ($j('.products-isotope').hasClass('three-in-row')){
                                    if (windowW > 560) {
                                        minW = $j('.products-isotope').width()/3;
                                    } else {
                                        minW = $j('.products-isotope').width()/1;
                                    }
                                } else if ($j('.products-isotope').hasClass('four-in-row')){
                                    if (windowW > 767) {
                                        minW = $j('.products-isotope').width()/4;
                                    } else if (windowW > 560) {
                                        minW = $j('.products-isotope').width()/3;
                                    } else {
                                        minW = $j('.products-isotope').width()/1;
                                    }
                                } else if ($j('.products-isotope').hasClass('five-in-row')){
                                    if (windowW > 991) {
                                        minW = $j('.products-isotope').width()/5;
                                    } else if (windowW > 767) {
                                        minW = $j('.products-isotope').width()/4;
                                    } else if (windowW > 560) {
                                        minW = $j('.products-isotope').width()/3;
                                    } else {
                                        minW = $j('.products-isotope').width()/1;
                                    }
                                } else if ($j('.products-isotope').hasClass('six-in-row')){
                                    if (windowW > 1199) {
                                        minW = $j('.products-isotope').width()/6;
                                    } else if (windowW > 991) {
                                        minW = $j('.products-isotope').width()/5;
                                    } else if (windowW > 767) {
                                        minW = $j('.products-isotope').width()/4;
                                    } else if (windowW > 560) {
                                        minW = $j('.products-isotope').width()/3;
                                    } else {
                                        minW = $j('.products-isotope').width()/1;
                                    }
                                } else if ($j('.products-isotope').hasClass('seven-in-row')){
                                    if (windowW > 1600) {
                                        minW = $j('.products-isotope').width()/7;
                                    } else if (windowW > 1199) {
                                        minW = $j('.products-isotope').width()/6;
                                    } else if (windowW > 991) {
                                        minW = $j('.products-isotope').width()/5;
                                    } else if (windowW > 767) {
                                        minW = $j('.products-isotope').width()/4;
                                    } else if (windowW > 560) {
                                        minW = $j('.products-isotope').width()/2;
                                    } else {
                                        minW = $j('.products-isotope').width()/1;
                                    }
                                } else if ($j('.products-isotope').hasClass('eight-in-row')){
                                    if (windowW > 1600) {
                                        minW = $j('.products-isotope').width()/8;
                                    } else if (windowW > 1199) {
                                        minW = $j('.products-isotope').width()/6;
                                    } else if (windowW > 991) {
                                        minW = $j('.products-isotope').width()/5;
                                    } else if (windowW > 767) {
                                        minW = $j('.products-isotope').width()/4;
                                    } else if (windowW > 560) {
                                        minW = $j('.products-isotope').width()/2;
                                    } else {
                                        minW = $j('.products-isotope').width()/1;
                                    }
                                }

                                setProductSize($j('.products-col'),minW);
                                $j('.products-isotope.products-col').isotope().isotope('layout');
                            });
                }
            })

            var prevW = window.innerWidth || $j(window).width();

            $j(window).resize(function() {
                var currentW = window.innerWidth || $j(window).width();

                if (currentW != prevW) {
                    // start resize events
                    if($j('.products-isotope').length) {
                        if ($j('.products-col').parent().parent().hasClass('open')) {
                            $j('.products-col').stop(true,false).animate({marginLeft: '0'}, 0);
                            $j('.products-col').find('.product-preview-wrapper').css("width", "");
                            var minW =  parseInt($j('.products-col').find('.product-preview-wrapper:first-child').width());
                            if ($j('.products-isotope').hasClass('two-in-row')){
                                minW = minW-200;
                            }
                            if ( $j('html').css('direction').toLowerCase() == 'rtl' ) {
                                $j('.products-col').stop(true,false).animate({marginRight: '280px'}, 200,
                                        function() {
                                            setProductSize($j('.products-col'),minW);
                                            $j('.products-isotope').isotope().isotope('layout');
                                        });

                            }
                            else {
                                $j('.products-col').stop(true,false).animate({marginLeft: '280px'}, 200,
                                        function() {
                                            setProductSize($j('.products-col'),minW);
                                            $j('.products-isotope').isotope().isotope('layout');
                                        });
                            }
                        }
                        else {
                            $j('.products-col').find('.product-preview-wrapper').css("width", "");
                            setProductSize($j('.products-col'),minW);
                            $j('.products-isotope.products-col').isotope().isotope('layout');
                        }
                    }


                    // end resize events
                }

                prevW = window.innerWidth || $j(window).width();

            });

        });

        // Isotope Filters (for index-original.html)
        jQuery(function ($) {
            "use strict";
            var hoverfold = $j(".products-isotope");
            if (hoverfold.length != 0) {
                var container = hoverfold;
                var optionSets = $j(".filters-by-category .option-set"),
                        optionLinks = optionSets.find("a");
                optionLinks.click(function () {
                    var thisLink = $(this);
                    if (thisLink.hasClass("selected")) return false;
                    var optionSet = thisLink.parents(".option-set");
                    optionSet.find(".selected").removeClass("selected");
                    thisLink.addClass("selected");
                    var options = {},
                            key = optionSet.attr("data-option-key"),
                            value = thisLink.attr("data-option-value");
                    value = value === "false" ? false : value;
                    options[key] = value;
                    if (key === "layoutMode" && typeof changeLayoutMode === "function") changeLayoutMode($this, options);
                    else container.isotope(options);
                    return false
                })
            }
        });

        // Grid / Row listing view
        jQuery(function($j) {

            "use strict";

            $j('.products-isotope.products-col').on( 'layoutComplete',  function() {
                window.setTimeout(function() {
                    $j('.products-isotope.products-col').removeClass('no-transition');
                },1000);
            })
            
            function remember(key, value) {
                $j.ajax({
                    url: "{{ URL::route('remember.cookie') }}",
                    dataType: "json",
                    type: "POST",
                    data: {key: key, value: value},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                });
            }

            $j('a.link-row-view').click(function(e) {
                var windowW = window.innerWidth || $(window).width();
                e.preventDefault();
                $j(this).addClass('active');
                $j('a.link-grid-view').removeClass('active');
                $j('.products-listing').addClass('row-view');

                remember('catalog-view', 'row');
                
                $j('.products-col').find('.product-preview-wrapper').css("width", "");
                if ($j('.outer').hasClass('open')) {
                    $j('.products-isotope.products-col').addClass('no-transition');
                    $j('.products-col').stop(true,false).animate({marginLeft: '0'}, 0);
                    var minW =  parseInt($j('.products-col').find('.product-preview-wrapper:first-child').width());
                    $j('.products-col').stop(true,false).animate({marginLeft: '280px'}, 0,
                            function() {
                                setProductSize($j('.products-col'),minW);
                                $j('.products-isotope.products-col').isotope('layout');
                            });
                }
                else {
                    $j('.products-isotope.products-col').addClass('no-transition').isotope('layout');
                }
            });

            $j('a.link-grid-view').click(function(e) {
                var windowW = window.innerWidth || $(window).width();
                e.preventDefault();
                $j(this).addClass('active');
                $j('a.link-row-view').removeClass('active');
                $j('.products-listing').removeClass('row-view');

                remember('catalog-view', 'grid');

                $j('.products-col').find('.product-preview-wrapper').css("width", "");
                if ($j('.outer').hasClass('open')) {
                    $j('.products-isotope.products-col').addClass('no-transition');
                    $j('.products-col').stop(true,false).animate({marginLeft: '0'}, 0);
                    $j('.products-col').find('.product-preview-wrapper').css("width", "");
                    var minW =  parseInt($j('.products-col').find('.product-preview-wrapper:first-child').width());
                    if ($j('.products-isotope').hasClass('two-in-row')){
                        minW = minW-200;
                    }
                    $j('.products-col').stop(true,false).animate({marginLeft: '280px'}, 0,
                            function() {
                                setProductSize($j('.products-col'),minW);
                                $j('.products-isotope.products-col').isotope('layout');
                            });
                }
                else {
                    $j('.products-isotope.products-col').addClass('no-transition').isotope('layout');
                }
            });
        });

        // Ajax-фильтры
        jQuery(function($j) {

            "use strict";

            var url = "{!! Request::getUri() !!}"

            function sortingAjax(name, value) {
                var data = {};
                data[name] = value;

                $j.ajax({
                    url: url,
                    dataType: "json",
                    type: "GET",
                    data: data,
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (response) {

                        removeLoader('.outer');

                        if(response.success) {
                            $j('.count-container').html(response.countHtml);
                            $j('#pagination').html(response.paginationHtml);
                            $j('.products-container').html(response.productsListHtml);

                            window.history.pushState({parent: response.pageUrl}, '', response.pageUrl);
                            url = response.pageUrl;
                        }
                    }
                });
            }

            $j(document).on('click', '.sort-direction', function (e) {

                addLoader('.outer');

                var name = 'direction',
                    value = $j(this).data('value');

                sortingAjax(name, value);
            });

            $j(document).on('change', '.ajax-sort', function (e) {

                addLoader('.outer');

                var name = $j(this).attr('name'),
                    value = $j(this).val();

                sortingAjax(name, value);
            });
        });
    </script>

@endpush