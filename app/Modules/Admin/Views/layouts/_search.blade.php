<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<form id="search-form" class="app-search" method="GET" action="{{ route('admin.products.index') }}">
	<input type="text" name="query" value="{{ \Request::get('query') }}" placeholder="Поиск товара..." class="form-control">
	<a href="#" onclick="document.getElementById('search-form').submit();"><i class="fa fa-search"></i></a>
</form>