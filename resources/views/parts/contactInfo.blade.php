<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(isset($siteSettings['contactInfo']) && is_array($siteSettings['contactInfo']))
    <h5 class="title text-uppercase">Контактная информация</h5>
    <div class="v-links-list">
        <ul class="contact-info">
            @if(isset($siteSettings['contactInfo']['address']) && is_object($siteSettings['contactInfo']['address']))
                <li class="icon icon-home">{{ $siteSettings['contactInfo']['address']->value }}</li>
            @endif
            @if(isset($siteSettings['contactInfo']['phones']) && is_object($siteSettings['contactInfo']['phones']))
                <li class="icon icon-telephone">{{ $siteSettings['contactInfo']['phones']->value }}</li>
            @endif
            @if(isset($siteSettings['contactInfo']['email']) && is_object($siteSettings['contactInfo']['email']))
                <li class="icon icon-mail email">
                    <a href="mailto:{{ $siteSettings['contactInfo']['email']->value }}">
                        {{ $siteSettings['contactInfo']['email']->value }}
                    </a>
                </li>
            @endif
            @if(isset($siteSettings['contactInfo']['skype']) && is_object($siteSettings['contactInfo']['skype']))
                <li class="icon icon-skype">{{ $siteSettings['contactInfo']['skype']->value }}</li>
            @endif
        </ul>
    </div>
@endif