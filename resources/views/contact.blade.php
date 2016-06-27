<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@extends('layouts.main')

@section('content')
    <!-- Breadcrumb section -->

    <section class="breadcrumbs">
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
                    <div id="contact-info">
                        @include('parts.contactInfo')
                    </div>
                    <div class="divider divider--sm visible-sm visible-xs"></div>
                </div>

                <div class="col-md-6">
                    {!! Form::open(['url' => route('letter.send'), 'id' => 'contact-form', 'class' => 'contact-form']) !!}

                        <h3 class="text-uppercase text-center">Отправить сообщение</h3>

                        <div id="success-message">
                            @include('parts.message', ['class' => 'success', 'icon' => 'icon-mail-fill'])
                        </div>

                        <div id="error-message">
                            @include('parts.message', ['class' => 'error'])
                        </div>

                        <div class="input-group input-group--wd">
                            {!! Form::text('name', null, ['id' => 'name', 'class' => 'input--full']) !!}
                            <span class="input-group__bar"></span>
                            <label>Ваше имя <span class="required">*</span></label>
                            <span class="help-block error name_error">
                                {{ $errors->first('name') }}
                            </span>
                        </div>
                        <div class="input-group input-group--wd">
                            {!! Form::text('email', null, ['id' => 'email', 'class' => 'input--full']) !!}
                            <span class="input-group__bar"></span>
                            <label>Ваш email-адрес <span class="required">*</span></label>
                            <span class="help-block error email_error">
                                {{ $errors->first('email') }}
                            </span>
                        </div>
                        <div class="input-group input-group--wd">
                            {!! Form::text('subject', null, ['id' => 'subject', 'class' => 'input--full']) !!}
                            <span class="input-group__bar"></span>
                            <label>Тема</label>
                            <span class="help-block error subject_error">
                                {{ $errors->first('subject') }}
                            </span>
                        </div>
                        <div class="input-group input-group--wd">
                            {!! Form::textarea('message', null, ['id' => 'message', 'class' => 'input--full']) !!}
                            <span class="input-group__bar"></span>
                            <label>Сообщение <span class="required">*</span></label>
                            <span class="help-block error message_error">
                                {{ $errors->first('message') }}
                            </span>
                        </div>

                        {!! Form::submit('Отправить сообщение', ['class' => 'pull-right btn btn--wd text-uppercase']) !!}
                    {!! Form::close() !!}
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

@push('scripts')
    <script type="text/javascript">
        jQuery(function($j) {

            $j('#contact-form').on('submit', function(event){
                event.preventDefault ? event.preventDefault() : event.returnValue = false;

                var $form = $j(this),
                    formData = $form.serialize(),
                    url = $form.attr('action');

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

                        $j('html, body').animate({
                            scrollTop: $j('#contact-form').offset().top - 100
                        }, 1000);

                        if(response.success){
                            $form.trigger('reset');
                            $j('#success-message').show().find('.infobox__text').text(response.message);
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
        });
    </script>
@endpush

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
                    map: map
                });
            }
        </script>
    @endif
@endpush