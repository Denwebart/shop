<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$data = isset($data) ? $data : (Request::all() ? Request::all() : []);
?>

{!! $models->appends($data)->links() !!}