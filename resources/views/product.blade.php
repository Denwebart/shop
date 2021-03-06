<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.main')

@section('content')
    <!-- Breadcrumb section -->
    <div class="breadcrumbs breadcrumbs-boxed">
        <div class="container">
            @include('parts.breadcrumbs')

            <ul id="productOther" class="product-other pull-right hidden-xs">
                @if(is_object($page->previous))
                    <li class="product-other__link product-prev">
                        <a href="{{ \App\Models\Page::getPageUrl($page->previous->category_id) . '/' . $page->previous->alias }}">
                            {{ $page->previous->title }}
                        </a>
                        <span class="product-other__link__image">
                            @if($page->previous->image)
                                <img src="{{ asset($page->getImagePath() . $page->previous->id . '/mini_' . $page->previous->image) }}" alt="{{ $page->previous->image_alt }}"/>
                            @else
                                <img src="{{ $page->getDefaultImage() }}" alt="{{ $page->previous->image_alt }}"/>
                            @endif
                        </span>
                    </li>
                @endif
                @if(is_object($page->next))
                    <li class="product-other__link product-next">
                        <a href="{{ \App\Models\Page::getPageUrl($page->previous->category_id) . '/' . $page->next->alias }}">
                            {{ $page->next->title }}
                        </a>
                        <span class="product-other__link__image">
                            @if($page->next->image)
                                <img src="{{ asset($page->getImagePath() . $page->next->id . '/mini_' . $page->next->image) }}" alt="{{ $page->next->image_alt }}"/>
                            @else
                                <img src="{{ $page->getDefaultImage() }}" alt="{{ $page->next->image_alt }}"/>
                            @endif
                        </span>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Content section -->
    <section class="content">
        <div class="container">
            <div class="row product-info-outer">
                <div class="col-sm-4 col-md-4 col-lg-5 hidden-xs">
                    <div class="product-main-image">
                        <div class="product-main-image__item">
                            <img class="product-zoom" src='{{ $page->getImageUrl('zoom') }}' data-zoom-image="{{ $page->getImageUrl('zoom') }}" alt="{{ $page->image_alt }}" />
                        </div>
                        <div class="product-main-image__zoom"></div>
                    </div>
                    @if(count($page->images))
                        <div class="product-images-carousel">
                            <ul id="smallGallery">
                                @foreach($page->images as $image)
                                    <li>
                                        <a href="#" data-image="{{ $image->getImageUrl('zoom') }}" data-zoom-image="{{ $image->getImageUrl('zoom') }}">
                                            <img src="{{ $image->getImageUrl('mini') }}" alt="{{ $image->image_alt }}"/>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="product-info col-sm-8 col-md-4 col-lg-4">
                    <div class="product-info__title">
                        <h2>{{ $page->title }}</h2>
                    </div>
                    {{--<div id="product-rating-mobile" class="pull-left rating product-rating visible-xs m-b-15 m-t-10"></div>--}}
                    <div class="product-info__sku pull-right">
                        Артикул: {{ $page->vendor_code }}
                        {{--<span class="label label-success m-l-10">В НАЛИЧИИ</span>--}}
                    </div>
                    <div class="clearfix visible-xs"></div>
                    <ul id="singleGallery" class="visible-xs">
                        <li><img src="{{ $page->getImageUrl('zoom') }}" alt="{{ $page->image_alt }}" /></li>
                        @foreach($page->images as $image)
                            <li><img src="{{ $image->getImageUrl('zoom') }}" alt="{{ $image->image_alt }}"/></li>
                        @endforeach
                    </ul>
                    <div class="price-box product-info__price">
                        <span class="price-box__new">{{ \App\Helpers\Str::priceFormat($page->getPrice()) }}</span>
                        {{--<span class="price-box__old">7 000 руб.</span>--}}
                    </div>
                    <div id="product-rating" class="rating product-rating p-b-20"></div>
                    @if($page->introtext)
                        <div class="divider divider&#45;&#45;xs product-info__divider"></div>
                        <div class="product-info__description">
                            {!! $page->introtext !!}
                        </div>
                    @endif

                    <div class="divider divider&#45;&#45;xs product-info__divider"></div>

                    @include('parts.productPropertySize', ['product' => $page])

                    @include('parts.productPropertyColor', ['product' => $page])

                    <label>Количество:</label>
                    <div class="outer">
                        <div class="input-group-qty pull-left">
                            <span class="pull-left"> </span>
                            <input type="text" name="product-quantity" class="add-to-cart__quantity input-number input--wd input-qty pull-left" value="1" min="1" max="1000" data-cart="quantity" data-product-id="{{ $page->id }}">
                            <span class="pull-left btn-number-container">
                                <button type="button" class="btn btn-number btn-number--plus" data-type="plus" data-field="product-quantity">+</button>
                                <button type="button" class="btn btn-number btn-number--minus" disabled="disabled" data-type="minus" data-field="product-quantity"> &#8211;</button>
                            </span>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn--wd text-uppercase add-to-cart" data-product-id="{{ $page->id }}">
                                Добавить в корзину
                            </button>
                        </div>
                    </div>
                    <div class="divider divider--xs"></div>
                    <ul class="product-links product-links--inline">
                        <li>
                            <a href="#" class="add-to-wishlist @if($page->inWishlist()) active @endif" data-product-id="{{ $page->id }}" rel="nofollow">
                                <span class="icon icon-favorite"></span>
                                <span class="dashed-bottom">Добавить в список желаний</span>
                            </a>
                        </li>
                    </ul>
                    <div class="social-links social-links--colorize social-links--invert social-links--padding pull-left">
                        <script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
                        <script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
                        <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,viber,whatsapp">
                        </div>
                    </div>
                </div>
                <div class="clearfix visible-xs"></div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <h4 class="align-center m-t-20">Дополнительная информация</h4>
                    <div class="card">
                        <div class="card__row">
                            Вы можете добавить свой контент здесь,
                            например акции или какую-то дополнительной информации
                            по оплате и доставке.
                        </div>
                        <div class="card__row card__row--icon">
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
                    {{--aria-controls="home"--}}
                    <a href="#description" role="tab" data-toggle="tab" class="text-uppercase">
                        Описание
                    </a>
                </li>
                <li>
                    <a href="#reviews" role="tab" data-toggle="tab" class="text-uppercase">
                        Отзывы
                        (<span class="count reviews-count">{{ count($productReviews) }}</span>)
                    </a>
                </li>
                <li><a href="#sizing-guide" role="tab" data-toggle="tab" class="text-uppercase">Таблица размеров</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content tab-content--wd">
                <div role="tabpanel" class="tab-pane active" id="description">
                    {!! $page->content !!}
                    <div class="divider divider--xs"></div>
                    <table class="table table-params">
                        <tbody>
                            @foreach($productProperties as $key => $property)
                                <tr>
                                    <td class="text-right">
                                        <strong>{{ $property->title }}</strong>
                                    </td>
                                    <td>
                                        @foreach($property->values as $key => $value)
                                            @if($key > 0)
                                                ,
                                            @endif
                                            {{ $value->value }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="reviews">
                    <div id="comments">
                        @include('parts.comments')
                    </div>
                    <div class="divider divider--xs"></div>
                    <div class="row">
                        <div class="col-sm-5 col-md-4 col-lg-3">

                        </div>
                        <div class="col-sm-7 col-md-8 col-lg-9">
                            {!! Form::open(['url' => route('comment.add', ['product_id' => $page->id]), 'id' => 'comment-form', 'class' => 'contact-form']) !!}

                                {!! Form::hidden('parent_id', 0) !!}
                                {!! Form::hidden('rating', null, ['id' => 'rating']) !!}

                                <h4>Оставить отзыв</h4>

                                <div id="success-message">
                                    @include('parts.message', ['class' => 'success', 'icon' => 'icon-mail-fill'])
                                </div>

                                <div id="error-message">
                                    @include('parts.message', ['class' => 'error'])
                                </div>

                                @if(\Auth::check())
                                    <div class="input-group m-b-15">
                                        <a href="{{ route('admin.users.show', ['id' => \Auth::user()->id]) }}">
                                            <img src="{{ \Auth::user()->getAvatarUrl() }}" alt="{{ \Auth::user()->login }}" class="img-rounded pull-left" width="30">
                                            <span class="pull-left m-l-10 m-t-5">{{ \Auth::user()->login }}</span>
                                        </a>
                                    </div>
                                @else
                                    <div class="input-group input-group--wd">
                                        {!! Form::text('user_name', null, ['id' => 'user_name', 'class' => 'input--full']) !!}
                                        <span class="input-group__bar"></span>
                                        <label>Имя <span class="required">*</span></label>
                                        <span class="help-block error user_name_error">
                                            {{ $errors->first('user_name') }}
                                        </span>
                                    </div>
                                    <div class="input-group input-group--wd">
                                        {!! Form::text('user_email', null, ['id' => 'user_email', 'class' => 'input--full']) !!}
                                        <span class="input-group__bar"></span>
                                        <label>Ваш email-адрес <span class="required">*</span></label>
                                        <span class="help-block error user_email_error">
                                            {{ $errors->first('user_email') }}
                                        </span>
                                    </div>
                                @endif

                                <div class="input-group m-b-15">
                                    <span class="rating-extended__num product-review-rating-number pull-left">0</span>
                                    <div id="product-review-rating-input" class="product-review-rating-input pull-left"></div>
                                    <br>
                                    <small class="help-block">
                                        Оцените товар, если хотите оставить отзыв о нем.
                                    </small>
                                </div>

                                <div class="input-group input-group--wd">
                                    {!! Form::textarea('text', null, ['id' => 'text', 'class' => 'input--full']) !!}
                                    <span class="input-group__bar"></span>
                                    <label>Отзыв <span class="required">*</span></label>
                                    <span class="help-block error text_error">
                                        {{ $errors->first('text') }}
                                    </span>
                                </div>

                                {!! Form::submit('Отправить', ['class' => 'btn btn--wd text-uppercase wave']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="sizing-guide">
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

    {!! $viewed->show() !!}
    {!! $viewed->addingToViewed($page->id) !!}
@endsection

@push('styles')
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/elevatezoom/jquery.elevatezoom.min.js') }}"></script>
    <!-- Magnific Popup core JS file -->
    <script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('vendor/countdown/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('vendor/countdown/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('vendor/jrate/jRate.min.js') }}"></script>

    <script type="text/javascript">

        jQuery(function($j) {
            "use strict";
            $j('#productOther > li').hover(function() {
                $j(this).toggleClass('show-image');
            });
        });

        // Without zoom previews switcher
        jQuery(function($j) {

            if (!$j('.product-zoom').length) {

                $j('#mainProductImg').css({'min-height': $j('#mainProductImg img').height(), 'min-width': $j('#mainProductImg img').width() })


                $j('#smallGallery a').click(function(e){
                    e.preventDefault();
                    $j('#smallGallery a').removeClass('active');
                    $j(this).addClass('active');
                    var targ = $j(this).parent('li').index();
                    var curImg = $j('#mainProductImg').find('div.product-main-image__item.active');
                    var cur = curImg.index();
                    if (targ == cur) {
                        return false;
                    }
                    else {
                        var newImg = $j('#mainProductImg').find('div.product-main-image__item:nth-child('+ (targ+1) +')');
                        curImg.removeClass('active');
                        newImg.addClass('active')
                    }
                })

            }

            var prevW = window.innerWidth || $j(window).width();

            $j(window).resize(debouncer(function(e) {

                var currentW = window.innerWidth || $j(window).width();
                if (currentW != prevW) {
                    // start resize events
                    if (!$j('.product-zoom').length) {

                        $j('#mainProductImg').css({'min-height': '', 'min-width': '' })
                        $j('#mainProductImg').css({'min-height': $j('#mainProductImg img').height(), 'min-width': $j('#mainProductImg img').width() })

                    }
                    // end resize events
                }
                prevW = window.innerWidth || $j(window).width();
            }));

        })

        // Magnific Popup on Product Image click

        jQuery(function($j) {

            if ($j('#mainProductImg .zoom-link').length) {
                $j('#mainProductImg').magnificPopup({
                    disableOn: 767,
                    delegate: '.zoom-link',
                    type: 'image',
                    mainClass: 'mfp-fade',
                    preloader: true,
                    fixedContentPos: false,
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1], // Will preload 0 - before current, and 1 after the current image
                    }
                });
            }
        })

        // Elevate Zoom

        jQuery(function($j) {

            var windowW = window.innerWidth || document.documentElement.clientWidth;
            $j('.product-zoom').imagesLoaded(function() {
                if ($j('.product-zoom').length) {
                    var zoomPosition
                    if ( $j('html').css('direction').toLowerCase() == 'rtl' ) {
                        zoomPosition = 11;
                    }
                    else {
                        zoomPosition = 1
                    }
                    if (windowW > 767) {
                        $j('.product-zoom').elevateZoom({
                            zoomWindowHeight: $j('.product-zoom').height(),
                            gallery: "smallGallery",
                            galleryActiveClass: 'active',
                            zoomWindowPosition	: zoomPosition
                        })
                    } else {
                        $j(".product-zoom").elevateZoom({
                            gallery: "smallGallery",
                            zoomType: "inner",
                            galleryActiveClass: 'active',
                            zoomWindowPosition	: zoomPosition
                        });
                    }
                }
            })


            $j('.product-main-image > .product-main-image__zoom ').bind('click', function(){


                galleryObj = [];
                current = 0;
                itemN = 0;

                if ($j('#smallGallery').length){
                    $j('#smallGallery li a').not('.video-link').each(function() {
                        if ($j(this).hasClass('active')) {
                            current = itemN;
                        }
                        itemN++;
                        var src = $j(this).data('zoom-image'),
                                type = 'image';
                        image = {};
                        image ["src"] = src;
                        image ["type"] = type;

                        galleryObj.push(image);
                    });
                }

                else {
                    itemN++;
                    var src = $j(this).parent().find('.product-zoom').data('zoom-image'),
                            type = 'image';
                    image = {};
                    image ["src"] = src;
                    image ["type"] = type;

                    galleryObj.push(image);
                }

                $j.magnificPopup.open({
                    items: galleryObj,
                    gallery: {
                        enabled: true,
                        tCounter: '%curr% из %total%'
                    }
                }, current);

            });

            var  prevW = windowW;


            $j(window).resize(debouncer(function(e) {
                var currentW = window.innerWidth || $j(window).width();

                if (currentW != prevW) {
                    // start resize events

                    $j('.zoomContainer').remove();
                    $j('.elevatezoom').removeData('elevateZoom');

                    if ($j('.product-zoom').length) {
                        if (currentW > 767) {
                            $j('.product-zoom').elevateZoom({
                                zoomWindowHeight: $j('.product-zoom').height(),
                                gallery: "smallGallery"
                            })
                        } else {
                            $j(".product-zoom").elevateZoom({
                                gallery: "smallGallery",
                                zoomType: "inner"
                            });
                        }
                    }


                    // end resize events
                }


                prevW = window.innerWidth || $j(window).width();


            }));
        });

        jQuery(function($j) {
            // Product Rating
            var productRatingOptions = {
                rating: '{{ $page->rating }}',
                width: 18,
                height: 18,
                shapeGap: '2px',
                startColor: '#F9BC39',
                endColor: '#F9BC39',
                readOnly: true
            };
            var productRating = $j(".product-rating").jRate(productRatingOptions);

            // Set product review rating
            var ratingInputOptions = {
                width: 18,
                height: 18,
                shapeGap: '2px',
                startColor: '#F9BC39',
                endColor: '#F9BC39',
                precision: 1.0,
                onSet: function (rating) {
                    $j('#product-review-rating-input').val(rating);
                    $j('.product-review-rating-number').text(rating);
                },
                onChange: function (rating) {
                    $j('.product-review-rating-number').text(rating);
                }
            };
            var ratingInput = $j("#product-review-rating-input").jRate(ratingInputOptions);

            // Comments form ajax
            $j('#comment-form').on('submit', function(event){
                event.preventDefault ? event.preventDefault() : event.returnValue = false;

                var $form = $j(this),
                    values = $form.serializeArray(),
                    url = $j(this).attr('action'),
                    rating = $j('#product-review-rating-input').val();

                values.push({
                    name: "rating",
                    value: rating
                });
                formData = jQuery.param(values);

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
                        $j('#success-message').hide().find('.infobox__text').text('');
                        $j('#error-message').hide().find('.infobox__text').text('');

                        if(response.success){
                            $form.trigger('reset');
                            ratingInput.setRating(0);
                            $j('#product-review-rating-input').val(0)
                            $j('.product-review-rating-number').text('0');

                            $j('#success-message').show().find('.infobox__text').text(response.message);
                            $j('#comments').html(response.commentsHtml);
                            $j('.reviews-count').html(response.commentsCount);

//                            $j(".product-rating").jRate(productRatingOptions);
                            productRating.setRating(response.newProductRating);
                            productRating = $j('.rating-in-comments').jRate(productRatingOptions);
                            productRating.setRating(response.newProductRating);

                            $j('html, body').animate({
                                scrollTop: $j('#review-' + response.id).offset().top - 100
                            }, 1000);
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

            $j(document).on('click', '.vote', function(event) {

                event.preventDefault ? event.preventDefault() : event.returnValue = false;

                var $button = $j(this),
                    $buttonParent = $button.parent('.review__helpful'),
                    id = $button.data('id'),
                    vote = $button.data('vote');

                $j.ajax({
                    url: '{{ route('comment.vote') }}',
                    dataType: "json",
                    type: "POST",
                    data: {'id': id, 'vote': vote},
                    async: true,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $j("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response) {
                        if(response.success){
                            $button.find('.count').text(response.voteCount);
                            $button.addClass('active');
                            $buttonParent.find('.help-block')
                                    .removeClass('error').addClass('success').text(response.message).show();
                        } else {
                            $buttonParent.find('.help-block')
                                    .removeClass('success').addClass('error').text(response.message).show();
                        }
                    }
                });
            });

            $j(document).on('click', '.show-comments', function(event) {

                event.preventDefault ? event.preventDefault() : event.returnValue = false;

                var $button = $j(this),
                    $commentsContainer = $button.parent('.review__comments').find('.comments'),
                    parent_id = $button.data('parentId');

                if($commentsContainer.is(':visible')) {
                    $commentsContainer.hide();
                } else {
                    $commentsContainer.show();
                }
            });
        });
    </script>

@endpush