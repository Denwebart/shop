<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
@if(isset($siteSettings['socialButtons']) && is_array($siteSettings['socialButtons']))
    <ul>
        @foreach($siteSettings['socialButtons'] as $socialButtonKey => $socialButton)
            @if(is_object($socialButton))
                <li class="social-links__item">
                    <a class="icon icon-{{ $socialButtonKey }} tooltip-link" href="{{ $socialButton->value }}" title="{{ $socialButton->title }}" target="_blank"></a>
                </li>
            @endif
        @endforeach
    </ul>
@endif