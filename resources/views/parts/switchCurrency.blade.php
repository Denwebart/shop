<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<a href="#" class="btn dropdown-toggle btn--links--dropdown header__dropdowns__button" data-toggle="dropdown" aria-expanded="false">
    <span class="header__dropdowns__button__text">Цены в: </span>
    <span class="header__dropdowns__button__symbol">
        @if(\Request::cookie('currency', 'RUB') == 'USD')
            <span class="currency__item__symbol">$</span>
            <span class="currency__item__title">(долларах)</span>
        @else
            <span class="currency__item__symbol">₽</span>
            <span class="currency__item__title">(рублях)</span>
        @endif
    </span>
    @if(isset($header) && $header)
        <span class="caret caret--dots"></span>
    @endif
</a>
<ul class="dropdown-menu animated fadeIn" role="menu">
	<li class="currency__item @if(\Request::cookie('currency', 'RUB') == 'RUB') active @endif">
		<a href="{{ route('currency.change', ['currency' => 'RUB']) }}">
			<span class="currency__item__symbol">₽</span>
			<span class="currency__item__title">(рублях)</span>
		</a>
	</li>
	@if($courseUSD)
	    <li class="currency__item @if(\Request::cookie('currency', 'RUB') == 'USD') active @endif">
		    <a href="{{ route('currency.change', ['currency' => 'USD']) }}">
			    <span class="currency__item__symbol">$</span>
			    <span class="currency__item__title">(долларах)</span>
		    </a>
	    </li>
	@endif
</ul>