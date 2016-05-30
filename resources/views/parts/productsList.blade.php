<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
<div class="products-grid @if(\Request::cookie('catalog-view', 'grid') == 'row') row-view @endif products-listing products-col products-isotope four-in-row">
    @each('parts.product', $products, 'item')
</div>

<div id="pagination" class="text-center">
    @include('parts.pagination', ['models' => $products])
</div>