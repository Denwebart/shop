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
                <div class="col-md-6 col-lg-6">
                    @if($page->title)
                        <h2 class="text-uppercase">{{ $page->title }}</h2>
                    @endif

                    {!! $page->content !!}

                    <div class="divider divider--sm"></div>
                    <div class="contact-info">
                        @include('parts.contactInfo')
                    </div>
                    <div class="divider divider--sm visible-sm visible-xs"></div>
                </div>

                <div class="col-md-6">
                    <form id="contactform" class="contact-form" name="contactform" method="post" novalidate>
                        <h3 class="text-uppercase text-center">Отправить сообщение</h3>
                        <div id="success">
                            <p>Ваше сообщение успешно отправлено!</p>
                        </div>
                        <div id="error">
                            <p>Ошибка. Что-то пошло не так.</p>
                        </div>
                        <div class="input-group input-group--wd">
                            <input type="text" class="input--full" name="name">
                            <span class="input-group__bar"></span>
                            <label>Ваше имя *</label>
                        </div>
                        <div class="input-group input-group--wd">
                            <input type="text" class="input--full" name="email">
                            <span class="input-group__bar"></span>
                            <label>Ваш email-адрес *</label>
                        </div>
                        <div class="input-group input-group--wd">
                            <input type="text" class="input--full" name="subject">
                            <span class="input-group__bar"></span>
                            <label>Тема</label>
                        </div>
                        <div class="input-group input-group--wd">
                            <textarea class="textarea--full" name="message"></textarea>
                            <span class="input-group__bar"></span>
                            <label>Сообщение</label>
                        </div>
                        <button type="submit" id="submit" class="pull-right btn btn--wd text-uppercase">
                            Отправить сообщение
                        </button>
                    </form>
                </div>
                <div class="divider divider--md"></div>
            </div>
        </div>
    </section>
    <!-- End Content section -->

    <!-- Map section -->
    @if(isset($contactPageSettings['map']) && isset($contactPageSettings['map']['latitude']) && isset($contactPageSettings['map']['longitude']))
        <section class="content fullwidth top-null bottom-null">
            <div id="map"></div>
        </section>
    @endif
    <!-- End Map section -->
@endsection

@push('styles')
    @if(isset($contactPageSettings['map']) && isset($contactPageSettings['map']['latitude']) && isset($contactPageSettings['map']['longitude']))
        <!-- Google map -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);

            function init() {
                // Moscow
                var latitude = "{{ $contactPageSettings['map']['latitude']->value }}";
                var longitude = "{{ $contactPageSettings['map']['longitude']->value }}";
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 11,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(latitude, longitude),

                    // How you would like to style the map.
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [{"color": "#8acefa"}] // #169ef5 opacity 50% - #8acefa
                    }, {
                        "featureType": "transit",
                        "stylers": [{"color": "#808080"}, {"visibility": "off"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [{"visibility": "on"}, {"color": "#b3b3b3"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [{"color": "#ffffff"}]
                    }, {
                        "featureType": "road.local",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"weight": 1.8}]
                    }, {
                        "featureType": "road.local",
                        "elementType": "geometry.stroke",
                        "stylers": [{"color": "#d7d7d7"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "on"}, {"color": "#ebebeb"}]
                    }, {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [{"color": "#a7a7a7"}]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "geometry.fill",
                        "stylers": [{"color": "#ffffff"}]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "geometry.fill",
                        "stylers": [{"color": "#ffffff"}]
                    }, {
                        "featureType": "landscape",
                        "elementType": "geometry.fill",
                        "stylers": [{"visibility": "on"}, {"color": "#efefef"}]
                    }, {
                        "featureType": "road",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#696969"}]
                    }, {
                        "featureType": "administrative",
                        "elementType": "labels.text.fill",
                        "stylers": [{"visibility": "on"}, {"color": "#737373"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "labels.icon",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "labels",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "geometry.stroke",
                        "stylers": [{"color": "#d6d6d6"}]
                    }, {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [{"visibility": "off"}]
                    }, {}, {"featureType": "poi", "elementType": "geometry.fill", "stylers": [{"color": "#dadada"}]}]
                };

                // Get the HTML DOM element that will contain your map
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude, longitude),
                    map: map,
    //                title: 'Координаты магазина.' // text when you hover over the marker
                });
            }
        </script>
    @endif
@endpush