<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<div class="infobox {{ $class or '' }}">
    <div class="infobox__icon"><span class="icon {{ $icon or 'icon-info' }}"></span></div>
    <div class="infobox__text">{{ $message or '' }}</div>
</div>
<div class="divider divider--sm"></div>